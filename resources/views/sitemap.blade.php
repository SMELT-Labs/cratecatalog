<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach(\App\Models\Box::all() as $box)
        <url>
            <loc>{{ route('detail', ['box' => $box]) }}</loc>
            <lastmod>{{ $box->updated_at->format('Y-m-d') }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>
