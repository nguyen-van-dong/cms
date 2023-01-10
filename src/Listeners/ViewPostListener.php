<?php

namespace Module\Cms\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Session\Store;
use Module\Cms\Events\ViewPostEvent;
use Module\Cms\Models\Post;

class ViewPostListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ViewPostEvent $event)
    {
        $post = $event->post;
        if (!$this->isPostViewed($post))
	    {
	        $post->increment('view_count');
	        $this->storePost($post);
	    }
    }

    private function isPostViewed($post)
	{
	    $viewed = $this->session->get('viewed_posts', []);

	    return array_key_exists($post->id, $viewed);
	}

	private function storePost($post)
	{
	    $key = 'viewed_posts.' . $post->id;

	    $this->session->put($key, time());
	}
}
