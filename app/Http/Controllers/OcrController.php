<?php

namespace App\Http\Controllers;

use Exception;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Http\Request;
use Imagick;

class OcrController extends Controller
{
    public function processFile(Request $request) {
        $request->validate([
            'base64_file' => 'required|string',
            'language' => 'sometimes|string|in:eng,spa,por,fra',
            'file_type' => 'required|string|in:image,pdf'
        ]);


        try {
            // Extraer archivo base64
            $base64_str = $request->base64_file;
            if (strpos($base64_str, ';base64,') !== false) {
                [$prefix, $base64_str] = explode(';base64,', $base64_str);
            }

            $file_data = base64_decode($base64_str);
            if (!$file_data) {
                throw new Exception("Formato base64 inválido");
            }

            $text = '';
            if ($request->file_type === 'image') {
                $text = $this->processImage($file_data, $request->language);
            } else if ($request->file_type === 'pdf') {
                $text = $this->processPdf($file_data, $request->language);
            }

            return response()->json([
                'success' => true,
                'text' => $text
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function processImage($image_data, $language)
    {
        $tempPath = tempnam(sys_get_temp_dir(), 'ocr_img');
        file_put_contents($tempPath, $image_data);

        $text = (new TesseractOCR($tempPath))
            ->lang($language ?? 'eng')
            ->run();

        unlink($tempPath);
        return $text;
    }

    private function processPdf($pdf_data, $language)
    {
        $tempPdfPath = tempnam(sys_get_temp_dir(), 'ocr_pdf');
        file_put_contents($tempPdfPath, $pdf_data);

        $text = '';
        $resolution = 300; // DPI para mejor calidad OCR
        
        try {
            // Convertir PDF a imágenes (una por página)
            $imagick = new Imagick();
            $imagick->setResolution($resolution, $resolution);
            $imagick->readImage($tempPdfPath);
            
            foreach ($imagick as $page) {
                $page->setImageFormat('png');
                
                $tempImagePath = tempnam(sys_get_temp_dir(), 'ocr_page');
                file_put_contents($tempImagePath, $page);
                
                $pageText = (new TesseractOCR($tempImagePath))
                    ->lang($language ?? 'eng')
                    ->run();
                
                $text .= $pageText . "\n\n";
                unlink($tempImagePath);
            }
            
            $imagick->clear();
        } finally {
            unlink($tempPdfPath);
        }

        return $text;
    }
}
