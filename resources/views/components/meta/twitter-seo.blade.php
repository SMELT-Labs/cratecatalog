@isset($title)
    <x-meta.og.title :title="$title" />
    <title>{{ $title }}</title>
@endisset

<x-meta.og.type :type="$type ?? 'article'" />
<x-meta.og.url :url="$url ?? url()->current()" />

@isset($description)
    <x-meta.og.description :description="$description" />
@endisset

@isset($image)
    <x-meta.og.image :image="$image" />
@endisset

@isset($twitterId)
    <x-meta.og.twitter-id :id="$twitterId" />
@endisset
