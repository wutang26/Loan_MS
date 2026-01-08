<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>403 | Access Denied</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded shadow text-center max-w-md">
    <h1 class="text-4xl font-bold text-red-600 mb-4">403</h1>
    <h2 class="text-xl font-semibold mb-2">Access Denied</h2>

    <p class="text-gray-600 mb-6">
        You do not have permission to access this page.
    </p>

    <div class="flex justify-center gap-4">
        <a href="{{ url()->previous() }}"
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            Go Back
        </a>

        <a href="{{ route('dashboard') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Dashboard
        </a>
    </div>
</div>

</body>
</html>
