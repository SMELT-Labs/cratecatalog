<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
<div {{ $attributes->merge(["class" => ""]) }}>
    <div class="flex items-center {{ $wrapperClass }} @margin($offsetY, $offsetX) flex-wrap">
        @foreach($children() as $child)
            @php
                $rawAttr = collect($child->tag->getAttributes())->map(function (\PHPHtmlParser\DTO\Tag\AttributeDTO $item) {
                        return $item->getValue();
                    });
                $classAttr = $rawAttr->get("class") ?? "";
                $attr = new \Illuminate\View\ComponentAttributeBag(
                    $rawAttr->forget("class")->toArray()
                );
            @endphp

            <div class="@padding($gapY, $gapX) {{$colClass}}">
                <{{$child->tag->name()}} {{ $attr }}
                    class="{{ $classAttr }}">
                    {!! $child->innerHtml() !!}
                </{{$child->tag->name()}}>
            </div>
       @endforeach
    </div>
</div>

