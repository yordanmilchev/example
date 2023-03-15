<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class BlogArticleEditLog extends Model
{
    protected $user = null;

    public function __construct($article = null, array $attributes = [])
    {
        parent::__construct($attributes);

        if (!empty($article) && empty($this->blog_article_id )) {
            $this->blog_article_id = $article->id;
        }

        if (empty($this->user_id)) {
            $this->user_id = \Auth::user()->id;
        }
    }

    /**
     * Defines relation to Product model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(BlogArticle::class, 'blog_article_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieve user
     *
     * @return |null
     */
    public function getUser()
    {
        if (!empty($this->user_id)) {
            $this->user = User::where('id', $this->user_id)->first();
        }

        return $this->user;
    }
}
