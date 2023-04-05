<?php namespace Visiosoft\CategoriesModule\Category\Command;

use DateTime;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use Visiosoft\CategoriesModule\Category\Contract\CategoryRepositoryInterface;

class CalculateLevel
{
    use DispatchesJobs;
    public function handle()
    {
        $date = new DateTime;
        $date->modify('-30 minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');

        $result = DB::table('categories_category')
            ->select('id')
            ->where('level_at', '<', $formatted_date)
            ->where('level', '=', 0)
            ->orWhereNull('level_at')
            ->get();

        foreach ($result as $key => $category) {
            $this->calculateLevelByCategory($category->id);
        }
    }

    public function calculateLevelByCategory($category_id)
    {
        $categories = app(CategoryRepositoryInterface::class);
        $parents = null;

        if ($category = $categories->find($category_id)) {
            $parents_count = ($category->parent_category_id) ? 1 : 0;
            $parents[] = $category;
            for ($i = 0; $i < $parents_count; $i++) {
                if ($category = $categories->find($category->parent_category_id)) {
                    $parents[] = $category;
                    $parents_count++;
                }
            }
        }

        $level = (is_array($parents)) ? count($parents) : null;

        if ($level) {
            DB::table('categories_category')->where('id', $category_id)
                ->update(array(
                    'level' => $level,
                    'level_at' => now(),
                ));
        }
    }
}
