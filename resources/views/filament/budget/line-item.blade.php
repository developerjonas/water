<div class="space-y-2 p-2 border rounded">
    <h3 class="font-bold">{{ $item }}</h3>
    <div class="grid grid-cols-3 gap-2">
        <input type="number" name="budget_data[line_items][{{ $index }}][total_estimated]" placeholder="Estimated" class="input input-bordered w-full">
        <input type="number" name="budget_data[line_items][{{ $index }}][advance][0]" placeholder="Advance 1" class="input input-bordered w-full">
        <input type="number" name="budget_data[line_items][{{ $index }}][advance][1]" placeholder="Advance 2" class="input input-bordered w-full">
        <input type="number" name="budget_data[line_items][{{ $index }}][advance][2]" placeholder="Advance 3" class="input input-bordered w-full">
        <input type="number" name="budget_data[line_items][{{ $index }}][settlement][0]" placeholder="Settlement 1" class="input input-bordered w-full">
        <input type="number" name="budget_data[line_items][{{ $index }}][settlement][1]" placeholder="Settlement 2" class="input input-bordered w-full">
        <input type="number" name="budget_data[line_items][{{ $index }}][settlement][2]" placeholder="Settlement 3" class="input input-bordered w-full">
    </div>
</div>
