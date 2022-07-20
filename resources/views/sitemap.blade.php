<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 ">
    @foreach(\App\Models\Box::all() as $box)
        <url>
            <loc>{{ route('detail', ['box' => $box]) }}</loc>
            <lastmod>{{ $box->updated_at->format('Y-m-d') }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1</priority>
        </url>
        @for($i = 2; $i < 4; $i++)
            <url>
                <loc>{{ route("detail.$i", ['box' => $box]) }}</loc>
                <lastmod>{{ $box->updated_at->format('Y-m-d') }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0</priority>
            </url>
        @endfor
    @endforeach
</urlset>
