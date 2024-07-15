<?php
function sanitize_input($data): string
{
    return htmlspecialchars(stripslashes(trim($data)));
}