<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tag
;

class TagPolicy
{
        public function viewAny(User $user): bool
        {
            return true;
        }

        /**
         * Determine whether the user can view the model.
         */
        public function view(User $user,Tag $tag): bool
        {
            return true;
        }

        /**
         * Determine whether the user can create models.
         */
        public function create(User $user): bool
        {
            return $user->is_admin;
        }

        /**
         * Determine whether the user can update the model.
         */
        public function update(User $user, Tag $tag): bool
        {
            return $user->is_admin;
        }

        /**
         * Determine whether the user can delete the model.
         */
        public function delete(User $user, Tag $tag): bool
        {
            return $user->is_admin;
        }
    }

