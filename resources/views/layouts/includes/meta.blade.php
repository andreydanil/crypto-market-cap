<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="{{ \App\Library\SeoHelper::metaDescription(isset($coin) ? $coin : null) }}"/>
<meta name="keywords" content="{{ \App\Library\SeoHelper::metaKeywords(isset($coin) ? $coin : null) }}"/>
<meta name="author" content="{{ $app_name }}">

<meta property="og:url" content="{{ url('/') }}"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="{{ \App\Library\SeoHelper::title(isset($coin) ? $coin : null) }}"/>
<meta property="og:description" content="{{ \App\Library\SeoHelper::metaDescription(isset($coin) ? $coin : null) }}"/>
<meta property="og:image" content="{{ asset('asset/images/coinindex-cryptocurrency-script.png')  }}"/>

<meta name="twitter:card" content="summary"/>
<meta property="twitter:title" content="{{ \App\Library\SeoHelper::title(isset($coin) ? $coin : null) }}"/>
<meta property="twitter:description"
      content="{{ \App\Library\SeoHelper::metaDescription(isset($coin) ? $coin : null) }}"/>
<meta property="twitter:image" content="{{ asset('asset/images/coinindex-cryptocurrency-script.png')  }}"/>

<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('asset/images/favicon.png') }}">

<title>@yield('title') - {{ $app_name }}</title>