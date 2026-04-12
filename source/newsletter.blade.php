@extends('_layouts.main')

@section('body')
    <x-wrappers.contained>
        @forelse ($newsletter as $issue)
            @include('_components.preview-newsletter', ['post' => $issue])
        @empty
            <p class="opacity-60">No issues yet.</p>
        @endforelse
    </x-wrappers.contained>
@endsection
