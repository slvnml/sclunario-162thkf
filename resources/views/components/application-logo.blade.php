<a href="/" wire:navigate class="logo-link">
    <svg class="logo-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
        <defs>
            <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#ff3366;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#f5f5f5;stop-opacity:1" />
            </linearGradient>
        </defs>
        <polygon points="50,10 20,50 50,90 80,50" fill="none" stroke="url(#logoGrad)" stroke-width="3"/>
        <circle cx="50" cy="50" r="5" fill="url(#logoGrad)"/>
    </svg>
    <span class="logo-text">Mayari</span>
</a>