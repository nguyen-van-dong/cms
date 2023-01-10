<div class="share-buttons text-center">
    <h5><strong>{{ __('blog.share') }}!</strong></h5>

    <!-- Email -->
    <div class="p-1 share-button-container">
        <a href="mailto:?Subject=Sharing this blog post from DnSoft!&Body=I am sharing this blog post from DnSoft!{{ $item->url }}">
            <img src="{{ asset('assets/web/images/blog/email.png')}}" alt="Share website design email to Email" />
        </a>
    </div>

    <!-- Facebook -->
    <div class="p-1 share-button-container">
        <a href="http://www.facebook.com/sharer.php?u={{ $item->url }}" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('assets/web/images/blog/facebook.png')}}" alt="Share website design email to Facebook" />
        </a>
    </div>

    <!-- LinkedIn -->
    <div class="p-1 share-button-container">
        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ $item->url }}" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('assets/web/images/blog/linkedin.png')}}" alt="Share website design email to LinkedIn" />
        </a>
    </div>

    <!-- Print -->
    <div class="p-1 share-button-container">
        <a href="javascript:;" onclick="window.print()">
            <img src="{{ asset('assets/web/images/blog/print.png')}}" alt="Share website design email to Print" />
        </a>
    </div>

    <!-- Reddit -->
    <div class="p-1 share-button-container">
        <a href="http://reddit.com/submit?url={{ $item->url }}&amp;title=How To Improve Your Laravel Development Skills By Reading Code" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('assets/web/images/blog/reddit.png')}}" alt="Share website design email to Reddit" />
        </a>
    </div>

    <!-- Twitter -->
    <div class="p-1 share-button-container">
        <a href="https://twitter.com/share?url={{ $item->url }}&amp;text=How To Improve Your Laravel Development Skills By Reading Code&amp;hashtags=ashallendesign,webdesign" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('assets/web/images/blog/twitter.png')}}" alt="Share website design email to Twitter" />
        </a>
    </div>
</div>