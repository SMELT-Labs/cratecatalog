<?php

namespace App\Policies;


use App\Models\User;
use Spatie\Comments\Models\Comment;
use Spatie\Comments\Models\Concerns\Interfaces\CanComment;
use Spatie\LivewireComments\Policies\CommentPolicy;

class CustomCommentPolicy extends CommentPolicy
{
    public function update($user, Comment $comment): bool
    {
        if ($user->admin) {
            return true;
        }

        return parent::update($user, $comment);
    }

    public function delete($user, Comment $comment): bool
    {
        if ($user->admin) {
            return true;
        }

        return parent::update($user, $comment);
    }
}
