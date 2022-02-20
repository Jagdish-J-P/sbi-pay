<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
</head>

<body>
    <div class="font-sans antialiased text-gray-900">
        <form id="form" method="post" action="{{ $request->url }}" {{-- x-data x-init="$refs.submit.click()" --}}>

            <input type="hidden" name="EncryptTrans" value="{{ $request->checkSum; }}">
            <input type="hidden" name="merchIdVal" value="{{ $request->merchantId; }}" />
            <input type="hidden" name="MultiAccountInstructionDtls" value="{{ $request->multiAccountCheckSum; }}" />
            <input type="submit" value="Proceed with Payment" x-ref="submit" name="Submit"{{--  style=" display: none;" --}}>
        </form>
    </div>
</body>

</html>
