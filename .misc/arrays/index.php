<?php

class Post
{
    public $title;
    public $author;
    public $published;

    public function __construct($title, $author, $published)
    {
        $this->title = $title;
        $this->author = $author;

        $this->published = $published;
    }
}

$posts = [
    new Post('My First Post', 'BA', true),
    new Post('My Second Post', 'FD', true),
    new Post('My Third Post', 'TY', true),
    new Post('My Fourth Post', 'HK', false),
];

// Filters posts and returns a new array containing only unpublished posts:
$unpublishedPosts = array_filter($posts, function ($post) {
    return !$post->published;
});

// NOTE: PHP's syntax is inconsistent re: filtering/mapping arrays.  The first
// argument in array_filter() is the array to iterate through, while the second
// argument is a callback function.  The arguments are reserved in array_map().

// Iterates over posts and transforms each post object into an array:
$modified = array_map(function ($post) {
    return (array) $post;
}, $posts);

// Iterates over posts and returns each post title in an associative array:
$objectTitles = array_map(function ($post) {
    return ['title' => $post->title];
}, $posts);

// Iterates over posts (first argument) and returns an array of each author
// (second argument) with the title (third argument) as the key for each
// author, rather than using an index number for the key:
$stringTitles = array_column($posts, 'author', 'title');
