<x-filament::page>
    <form method="POST" action="{{ route('filament.schemes.upload') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".xlsx,.csv" required>
        <button type="submit" class="filament-button filament-button-primary mt-2">Upload</button>
    </form>
</x-filament::page>
