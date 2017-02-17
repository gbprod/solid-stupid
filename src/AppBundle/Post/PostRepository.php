<?php

namespace AppBundle\Post;

interface PostRepository
{
    public function all();

    public function save($post);

    public function find($id);
}
