<?php
namespace App\Policies;

use App\Article;
use App\User;

class ArticlePolicy {
  /**
   * Determine if the given user can create articles.
   *
   * @param  \App\User  $user
   * @return bool
   */
  public function store(User $user) {
    // dd($user);
    // As long as the user is real, allowed
    return $user->id != null;
  }

  /**
   * Determine if the given article can be updated by the user.
   *
   * @param  \App\User    $user
   * @param  \App\Article  $article
   * @return bool
   */
  public function update(User $user, Article $article) {
    // Only if the user is the owner of the article
    return $user->id == $article->user_id;
  }

}
