<span class="flex items-center col-span-3">
    {{ __('Showing') }} {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} {{ __('of') }} {{ $paginator->total() }}
</span>
<span class="col-span-2"></span>
<span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
    <nav aria-label="Table navigation">
        <ul class="inline-flex items-center">
            <li>
                @if ($paginator->onFirstPage())
                    <div class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                      <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                      </svg>
                    </div>
                @else
                    <button wire:click="previousPage" dusk="previousPage.after" class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                        <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                @endif
            </li>
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <button class="px-3 py-1">
                          {{ $element }}
                        </button>
                    </li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            @if ($page == $paginator->currentPage())
                                <button wire:key="paginator-page{{ $page }}" class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                    {{ $page }}
                                </button>
                            @else
                                <button wire:click="gotoPage({{ $page }})" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                    {{ $page }}
                                </button>
                            @endif
                            </li>
                    @endforeach
                @endif
            @endforeach
            <li>
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" dusk="nextPage.after" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"aria-label="Next">
                      <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                      </svg>
                    </button>
                @else
                    <div class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"aria-label="Next">
                      <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                      </svg>
                    </div>
                @endif
            </li>
        </ul>
    </nav>
</span>
