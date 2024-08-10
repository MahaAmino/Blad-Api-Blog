<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

class CommentPolicy
{

    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comment $com): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $com): bool
    {
        return ($user->id === $com->user_id );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return ($user->id === $comment->user_id) || ($user->is_admin)|| ($user->id === $comment->post->user_id );
    }


}
