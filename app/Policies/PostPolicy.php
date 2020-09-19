<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    function edit(User $user, Post $post) {
        if($user->can('edit all posts') || $user->can('posts.edit.' . $post->id)) {
            return true;
        }

        return $post->user_id == $user->id;
    }

    function update(User $user, Post $post) {
        if($user->can('update all posts') || $user->can('posts.edit.' . $post->id)) {
            return true;
        }

        return $post->user_id == $user->id;
    }


    function show(User $user = null, Post $post) {
        if ($post->published) {
            return true;
        }

        if ($user == null) {
            return false;
        }

        if ($user->can('view unpublished posts')) {
            return true;
        }

        return $post->user_id == $user->id;
    }

    function destroy(User $user) {
        if($user->can('can delete post')) {
            return true;
        }
    }

    function salient(User $user, Post $post) {
        return $user->id == $post->user_id;
    }

    function publish(User $user) {
        return $user->can('publish post');
    }

    function unpublish(User $user) {
        return $user->can('unpublish post');
    }
}




















