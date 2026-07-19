<div
    x-cloak
    x-show="removeModal"
    x-transition.opacity
    @keydown.escape.window="closeRemove()"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm">

    <div
        x-show="removeModal"
        x-transition
        @click.outside="closeRemove()"
        class="w-full max-w-lg overflow-hidden bg-white shadow-2xl rounded-2xl">

        {{-- Modal Heading --}}
        <div class="flex items-start justify-between gap-4 px-6 py-5 border-b border-slate-200">

            <div class="flex items-center gap-4">

                <div class="flex items-center justify-center w-11 h-11 text-red-600 bg-red-100 rounded-xl shrink-0">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4M12 17h.01"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.3 3.7 2.6 17
                               A2 2 0 0 0 4.3 20h15.4
                               a2 2 0 0 0 1.7-3L13.7 3.7
                               a2 2 0 0 0-3.4 0Z"/>
                    </svg>

                </div>

                <div>
                    <h2 class="text-xl font-bold text-slate-900">
                        Remove Product Listing
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        This product will be hidden from buyers.
                    </p>
                </div>

            </div>

            <button
                type="button"
                @click="closeRemove()"
                aria-label="Close removal modal"
                class="p-2 transition rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100">

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 6l12 12M18 6 6 18"/>
                </svg>

            </button>

        </div>

        {{-- Removal Form --}}
        <form :action="removeAction" method="POST" class="p-6">

            @csrf
            @method('PATCH')

            <div class="p-4 border border-red-200 bg-red-50 rounded-xl">

                <p class="text-sm text-red-700">
                    You are removing:
                </p>

                <p
                    class="mt-1 font-bold text-red-800"
                    x-text="removeProductName">
                </p>

            </div>

            <div class="mt-5">

                <label
                    for="removalReason"
                    class="block text-sm font-semibold text-slate-700">

                    Removal Reason
                    <span class="text-red-500">*</span>

                </label>

                <textarea
                    id="removalReason"
                    x-ref="removalReason"
                    name="removal_reason"
                    rows="4"
                    minlength="5"
                    maxlength="500"
                    required
                    placeholder="Explain why this product listing is being removed..."
                    class="w-full px-4 py-3 mt-2 border border-slate-300 resize-none rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-100"></textarea>

                <p class="mt-2 text-xs text-slate-500">
                    The reason must contain between 5 and 500 characters.
                </p>

            </div>

            <div class="flex flex-col-reverse gap-3 mt-6 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    @click="closeRemove()"
                    class="px-6 py-3 font-semibold transition border border-slate-300 text-slate-700 rounded-xl hover:bg-slate-50">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 font-semibold text-white transition bg-red-600 rounded-xl hover:bg-red-700">

                    Remove Product

                </button>

            </div>

        </form>

    </div>

</div>