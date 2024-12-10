<div>

    {{-- @dd(\Storage::disk('public')->exists($pdf_file)) --}}
    <embed width="100%" height="100vh" style="height:100vh" src="{{ asset('storage/'.$pdf_file) }}" type="application/pdf"></embed>
</div>