<?php

namespace App\View\Components;

use Illuminate\View\Component;
use PHPHtmlParser\Dom;

class Spacer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public int $gap;
    public int $gapX;
    public int $gapY;
    public int $offsetX;
    public int $offsetY;
    public string $colClass;
    public string $wrapperClass;
    private Dom $dom;


    public function __construct($gap=null, $gapX=null, $gapY=null, $colClass=null, $wrapperClass=null)
    {
        $this->gap = $gap ?? 3;
        $this->gapX = $gapX ?? $this->gap;
        $this->gapY = $gapY ?? $this->gap;
        $this->offsetX = $this->gapX * -1;
        $this->offsetY = $this->gapY * -1;
        $this->colClass = $colClass ?? "w-1/3";
        $this->wrapperClass = $wrapperClass ?? "justify-between";
    }

    public function dom() {
        return $this->dom;
    }

    public function children() {
        return collect($this->dom->getChildren())->filter(function ($item) {
            return $item instanceof Dom\Node\HtmlNode;
        });
    }

    private function setDom(Dom $dom) {
        $this->dom = $dom;
    }

    private function loadSlot($slot) {
        $dom = new \PHPHtmlParser\Dom();
        $dom->loadStr($slot->toHtml());
        $this->setDom($dom);
    }

//    public function gap() {
//        return $this->gap;
//    }

//    public function gapX() {
//        return $this->gapX;
//    }

//    public function gapY() {
//        return $this->gapY;
//    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function ($data) {
            $this->loadSlot($data['slot']);
            return 'components.spacer';
        };
    }
}
