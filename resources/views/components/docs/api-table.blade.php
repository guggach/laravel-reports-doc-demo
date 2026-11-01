@props(['rows' => []])

<div {{ $attributes->merge(['class' => 'mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white dark:border-white/10 dark:bg-white/5']) }}>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <tbody>
                @foreach ($rows as $row)
                    <tr class="border-b border-slate-100 last:border-0 dark:border-white/5">
                        <th class="w-full max-w-md px-4 py-3 align-top font-mono text-[13px] font-medium leading-6 text-slate-900 sm:w-2/5 dark:text-white">
                            {{ $row['sig'] }}
                        </th>
                        <td class="px-4 py-3 align-top leading-6 text-slate-600 dark:text-slate-300">
                            {{ $row['text'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
