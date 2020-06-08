<?php

class PaginationController extends Controller {

    public function index () {

    }

    public function pagination ($currentPage, $comments, $commentsOnPage, $link = '', $linkId = '') {
        if ( $comments <=  $commentsOnPage )
            return '';
        $result = '<div class="comment-page-buttons">';
        $lastPage = ceil($comments /  $commentsOnPage);
        $firstPage = 1;
        //До текущей страницы
        if ( $currentPage > ( $firstPage + 2 ) )
            $result .= $this->page($link, $linkId, $firstPage);
        if ( $currentPage > ( $firstPage + 3 ) )
            $result .= '<div class="comment-page-dots">...</div>';
        if ( $currentPage > ( $firstPage + 1 ) )
            $result .= $this->page($link, $linkId, $currentPage - 2);
        if ( $currentPage > ( $firstPage ) )
            $result .= $this->page($link, $linkId, $currentPage - 1);
        //Текущая страница
        $result .= $this->currentPage($currentPage);
        //После текущей страницы
        if ( $currentPage < ( $lastPage - 1 ) )
            $result .= $this->page($link, $linkId, $currentPage + 1);
        if ( $currentPage < ( $lastPage - 2 ) )
            $result .= $this->page($link, $linkId, $currentPage + 2);
        if ( $currentPage < ( $lastPage - 3 ) )
            $result .= '<div class="comment-page-dots">...</div>';
        if ( $currentPage < ( $lastPage ) )
            $result .= $this->page($link, $linkId, $lastPage);

        $result .= '</div>';
        return $result;
    }

    public function page ($link = '', $linkId = '', $number = '') {
        if ( $link && $linkId )
            $result = '<a href="/'. $link .'/'. $linkId .'/'. $number .'"><div class="comment-page-button">'. $number .'</div></a>';
        elseif ( $link )
            $result = '<a href="/'. $link .'/'. $number .'"><div class="comment-page-button">'. $number .'</div></a>';
        else
            $result = '<a href="/'. $number .'"><div class="comment-page-button">'. $number .'</div></a>';
        return $result;
    }

    public function currentPage ($number) {
        $result = '<div class="comment-page-button current-page-button">'. $number .'</div>';
        return $result;
    }



}
