@extends('_layouts.main')

@section('body')
    <div class="text-black">
        {{-- Header section with explanation --}}
        <x-wrappers.full background="#ff0000" as="section">
            <x-wrappers.contained>
                <div class="py-12 text-center">
                    <div class="mb-4 text-4xl font-bold text-white">Wrapper System Test Page</div>
                    <div class="text-lg text-white">
                        Demonstrating all four wrapper types: full, Contained, Grid, and Flex
                    </div>
                </div>
            </x-wrappers.contained>
        </x-wrappers.full>

        {{-- 1. full WRAPPER DEMO --}}
        <x-wrappers.full background="#e2e8f0" as="section">
            <x-wrappers.contained>
                <div class="py-8">
                    <div class="mb-4 border-b pb-2 text-2xl font-bold text-black">1. full Wrapper</div>
                    <div class="mb-2 text-black">
                        <span class="rounded bg-gray-200 px-2 py-1 font-mono text-sm">&lt;x-wrappers.full&gt;</span>
                    </div>
                    <div class="rounded-lg bg-white p-6 shadow">
                        <div class="text-black">
                            This section has a gray background that stretches edge-to-edge (full).
                        </div>
                        <div class="mt-2 text-sm text-black text-gray-500">
                            Notice how the background color extends to the very edges of the browser window.
                        </div>
                    </div>
                </div>
            </x-wrappers.contained>
        </x-wrappers.full>

        {{-- 2. CONTAINED WRAPPER DEMO --}}
        <x-wrappers.full as="section">
            <x-wrappers.contained>
                <div class="py-8">
                    <div class="mb-4 border-b pb-2 text-2xl font-bold text-black">2. Contained Wrapper</div>
                    <div class="mb-2 text-black">
                        <span class="rounded bg-gray-200 px-2 py-1 font-mono text-sm">
                            &lt;x-wrappers.contained&gt;
                        </span>
                    </div>

                    {{-- Default contained --}}
                    <div class="mb-6 rounded-lg bg-blue-50 p-6 shadow">
                        <div class="mb-2 font-semibold text-black">Default (max-w-7xl + padding)</div>
                        <div class="text-black">
                            This content is inside a contained wrapper with max width and padding.
                        </div>
                        <div class="text-sm text-black text-gray-500">
                            Resize browser to see max-width constraint and responsive padding.
                        </div>
                    </div>

                    {{-- Custom max width demo --}}
                    <x-wrappers.contained maxWidth="max-w-4xl" padding>
                        <div class="rounded-lg border-2 border-green-200 bg-green-50 p-6 shadow">
                            <div class="mb-2 font-semibold text-black">Custom Width (max-w-4xl)</div>
                            <div class="text-black">
                                This contained wrapper has
                                <span class="font-mono">maxWidth="max-w-4xl"</span>
                            </div>
                        </div>
                    </x-wrappers.contained>

                    {{-- No padding demo --}}
                    <div class="mt-6">
                        <x-wrappers.contained padding="false">
                            <div class="rounded-lg border-2 border-yellow-200 bg-yellow-50 p-6 shadow">
                                <div class="mb-2 font-semibold text-black">No Padding Mode</div>
                                <div class="text-black">
                                    This contained wrapper has
                                    <span class="font-mono">padding="false"</span>
                                </div>
                                <div class="text-sm text-black text-gray-500">
                                    Useful for nested containers or when you need custom internal spacing.
                                </div>
                            </div>
                        </x-wrappers.contained>
                    </div>
                </div>
            </x-wrappers.contained>
        </x-wrappers.full>

        {{-- 3. GRID WRAPPER DEMO --}}
        <x-wrappers.full background="#f1f5f9" as="section">
            <x-wrappers.contained>
                <div class="py-8">
                    <div class="mb-4 border-b pb-2 text-2xl font-bold text-black">3. Grid Wrapper</div>
                    <div class="mb-4 text-black">
                        <span class="rounded bg-gray-200 px-2 py-1 font-mono text-sm">&lt;x-wrappers.grid&gt;</span>
                    </div>

                    {{-- 2 columns --}}
                    <div class="mb-2 font-semibold text-black">2 Columns (cols="2")</div>
                    <x-wrappers.grid cols="2" gap="gap-4" class="mb-8">
                        @foreach (range(1, 4) as $i)
                            <div class="rounded border-l-4 border-blue-500 bg-white p-4 shadow">
                                <div class="font-bold text-black">Item {{ $i }}</div>
                                <div class="text-sm text-black text-gray-600">2-column grid item</div>
                            </div>
                        @endforeach
                    </x-wrappers.grid>

                    {{-- 3 columns --}}
                    <div class="mb-2 font-semibold text-black">3 Columns (cols="3")</div>
                    <x-wrappers.grid cols="3" gap="gap-6" class="mb-8">
                        @foreach (range(1, 6) as $i)
                            <div class="rounded border-t-4 border-green-500 bg-white p-4 shadow">
                                <div class="font-bold text-black">Item {{ $i }}</div>
                                <div class="text-sm text-black text-gray-600">3-column grid item</div>
                            </div>
                        @endforeach
                    </x-wrappers.grid>

                    {{-- 4 columns --}}
                    <div class="mb-2 font-semibold text-black">4 Columns (cols="4")</div>
                    <x-wrappers.grid cols="4" gap="gap-2">
                        @foreach (range(1, 8) as $i)
                            <div class="rounded border-b-4 border-purple-500 bg-white p-3 text-center shadow">
                                <div class="font-bold text-black">{{ $i }}</div>
                            </div>
                        @endforeach
                    </x-wrappers.grid>
                </div>
            </x-wrappers.contained>
        </x-wrappers.full>

        {{-- 4. FLEX WRAPPER DEMO --}}
        <x-wrappers.full as="section">
            <x-wrappers.contained>
                <div class="py-8">
                    <div class="mb-4 border-b pb-2 text-2xl font-bold text-black">4. Flex Wrapper</div>
                    <div class="mb-4 text-black">
                        <span class="rounded bg-gray-200 px-2 py-1 font-mono text-sm">&lt;x-wrappers.flex&gt;</span>
                    </div>

                    {{-- Row direction with different justify options --}}
                    <div class="mb-2 font-semibold text-black">Row + justify="between"</div>
                    <x-wrappers.flex justify="between" class="mb-6 rounded-lg bg-gray-100 p-4">
                        <div class="rounded bg-blue-500 p-3 text-white">Left</div>
                        <div class="rounded bg-green-500 p-3 text-white">Center</div>
                        <div class="rounded bg-purple-500 p-3 text-white">Right</div>
                    </x-wrappers.flex>

                    <div class="mb-2 font-semibold text-black">Row + justify="center" + align="center"</div>
                    <x-wrappers.flex justify="center" align="center" class="mb-6 h-32 rounded-lg bg-gray-100 p-4">
                        <div class="rounded bg-blue-500 p-3 text-white">Centered</div>
                        <div class="rounded bg-green-500 p-3 text-white">Horizontally</div>
                        <div class="rounded bg-purple-500 p-3 text-white">& Vertically</div>
                    </x-wrappers.flex>

                    {{-- Column direction --}}
                    <div class="mb-2 font-semibold text-black">Column direction + align="center"</div>
                    <x-wrappers.flex direction="col" align="center" class="mb-6 rounded-lg bg-gray-100 p-4">
                        <div class="mb-2 w-32 rounded bg-blue-500 p-3 text-white">Top</div>
                        <div class="mb-2 w-48 rounded bg-green-500 p-3 text-white">Middle</div>
                        <div class="w-40 rounded bg-purple-500 p-3 text-white">Bottom</div>
                    </x-wrappers.flex>

                    {{-- Complex real-world example --}}
                    <div class="mb-2 font-semibold text-black">Real-world: Feature split</div>
                    <x-wrappers.flex
                        direction="col"
                        md-direction="row"
                        justify="between"
                        align="center"
                        class="rounded-lg bg-gradient-to-r from-blue-50 to-purple-50 p-6"
                    >
                        <div class="mb-4 w-full md:mb-0 md:w-1/2">
                            <div class="text-xl font-bold text-black">Left Content</div>
                            <div class="text-black text-gray-600">
                                This side has text content. On mobile, it stacks vertically.
                            </div>
                            <div class="mt-2 text-sm text-black text-gray-500">
                                Resize browser to see the responsive behavior.
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 md:pl-8">
                            <div class="rounded bg-white p-4 shadow">
                                <div class="font-semibold text-black">Right Content</div>
                                <div class="text-sm text-black">This could be an image, form, or any component.</div>
                            </div>
                        </div>
                    </x-wrappers.flex>
                </div>
            </x-wrappers.contained>
        </x-wrappers.full>

        {{-- Footer with visual indicators --}}
        <x-wrappers.full background="#1e293b" as="footer">
            <x-wrappers.contained>
                <div class="py-8 text-white">
                    <x-wrappers.flex justify="between" align="center">
                        <div>
                            <span class="text-sm opacity-75">Wrapper Test Page</span>
                        </div>
                        <div class="flex space-x-4">
                            <span class="rounded-full bg-white/20 px-3 py-1 text-xs">full</span>
                            <span class="rounded-full bg-white/20 px-3 py-1 text-xs">Contained</span>
                            <span class="rounded-full bg-white/20 px-3 py-1 text-xs">Grid</span>
                            <span class="rounded-full bg-white/20 px-3 py-1 text-xs">Flex</span>
                        </div>
                    </x-wrappers.flex>
                </div>
            </x-wrappers.contained>
        </x-wrappers.full>
    </div>
@endsection
