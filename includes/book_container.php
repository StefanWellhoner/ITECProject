<?php

function component($bookID, $bookTitle, $bookImage, $bookPrice)
{
    $bookContainer = "
<div class=\"col-lg-3 col-md-4 col-sm-6\">
    <div class=\"book-container\">
        <a href=\"viewbook.php?id=$bookID\">
            <img src=\"$bookImage\" class=\"book-img\" />
            <div class=\"book-info-container\">
                <div class=\"book-name\" title=\"$bookTitle\">$bookTitle</div>
                <p class=\"book-price\">R $bookPrice</p>
            </div>
        </a>
    </div>
</div>
";

    return $bookContainer;
}
