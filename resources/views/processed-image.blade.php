<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Filters\FilterInterface;

class RemoveBackgroundController extends Controller
{
    public function index()
    {
        // Mengambil URL gambar pratinjau dari session
        $previewImageUrl = session('preview_image');

        // Mengambil URL gambar yang telah diproses dari session
        $processedImageUrl = session('processed_image');

        // Menghapus URL gambar yang telah diproses dari session
        session()->forget('processed_image');

        // Mengembalikan tampilan index dengan URL gambar pratinjau dan URL gambar yang telah diproses
        return view('index', compact('previewImageUrl', 'processedImageUrl'));
    }

    public function removeBackground(Request $request)
    {
        // Validasi request
        $request->validate([
            'image' => 'required|image',
        ]);

        // Mengambil file gambar dari request
        $image = $request->file('image');

        // Menggunakan Intervention Image untuk memproses gambar
        $imagePath = $image->getPathname();
        $image = Image::make($imagePath)->encode('png');

        // Melakukan penghapusan latar belakang
        $image = $this->removeBackgroundWithCustomFilter($image);

        // Menyimpan gambar yang telah diproses
        $filename = time() . '.png';
        $image->save(public_path('storage/images/' . $filename));

        // Mengembalikan URL gambar yang telah diproses
        $imageUrl = asset('storage/images/' . $filename);

        // Menghapus URL gambar pratinjau dari session
        $request->session()->forget('preview_image');

        // Mengatur URL gambar yang telah diproses ke dalam session
        $request->session()->put('processed_image', $imageUrl);

        // Mengembalikan response dengan URL gambar yang telah diproses
        return response()->json(['image_url' => $imageUrl]);
    }

    private function removeBackgroundWithCustomFilter($image)
    {
        // Lakukan proses penghapusan latar belakang menggunakan filter kustom

        // Membuat instance dari filter kustom
        $filter = new CustomFilter();

        // Menggunakan filter pada gambar
        $image = $image->filter($filter);

        return $image;
    }

    public function showProcessedImage()
    {
        // Mengambil URL gambar yang telah diproses dari session
        $processedImageUrl = session('processed_image');

        // Mengembalikan tampilan untuk menampilkan gambar yang telah diproses
        return view('processed-image', compact('processedImageUrl'));
    }

    public function downloadProcessedImage()
    {
        // Mengambil URL gambar yang telah diproses dari session
        $processedImageUrl = session('processed_image');

        // Mengambil nama file gambar
        $filename = basename($processedImageUrl);

        // Mengatur header untuk file download
        header("Content-Disposition: attachment; filename={$filename}");

        // Mengembalikan response dengan file gambar yang akan didownload
        return readfile($processedImageUrl);
    }
}
