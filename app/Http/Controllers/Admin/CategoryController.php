<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Cache;
use Artisan;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('category_last_url', url()->full());
        $catgeory = null;
        $sort_search = null;
        $categories = Category::orderBy('id', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $categories = $categories->where('en_name', 'like', '%' . $sort_search . '%');
        }
        if ($request->has('catgeory') && $request->catgeory !== '0') {
            $catgeory = $request->catgeory;
            $categories = $categories->whereHas('parentCategory', function ($q) use ($catgeory) {
                $q->where('id', $catgeory);
            });
        }
        $categories = $categories->paginate(15);

        $filterCategories = Category::where('parent_id', 0)->get();
        return view('admin.categories.index', compact('categories', 'sort_search', 'catgeory','filterCategories'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->where('is_active', 1)->get();

        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'en_name' => 'required',
            'slug' => 'required|unique:categories,slug',
        ],[
            'en_name.required' => 'English name field is required'
        ]);

        $category               = new Category;
        $category->en_name      = $request->en_name;
        $category->ar_name      = $request->ar_name;
        $category->so_name      = $request->so_name;
        $category->icon         = $request->icon;
        $category->parent_id    = $request->parent_id;
        $category->is_active    = $request->is_active;

        $slug                   = $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->name, '-');
        $same_slug_count        = Category::where('slug', 'LIKE', $slug . '%')->count();
        $slug_suffix            = $same_slug_count ? '-' . $same_slug_count + 1 : '';
        $slug                   .= $slug_suffix;

        $category->slug         = $slug;
        $category->save();

        Artisan::call('cache:clear');
        flash(translate('Category has been created successfully'))->success();
        return redirect()->route('categories.index');
    }

    public function edit(Request $request, $id)
    {
        $lang = $request->lang;
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', 0)->where('is_active', 1)->get();

        return view('admin.categories.edit', compact('category', 'categories', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'en_name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$id,
        ],[
            'en_name.required' => 'English name field is required'
        ]);

        $category = Category::findOrFail($id);
        $category->en_name      = $request->en_name;
        $category->ar_name      = $request->ar_name;
        $category->so_name      = $request->so_name;
        $category->icon         = $request->icon;
        $category->parent_id    = $request->parent_id;
        $category->is_active    = $request->is_active;

        $slug                   = $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->name, '-');
        $same_slug_count        = Category::where('slug', 'LIKE', $slug . '%')->count();
        $slug_suffix            = ($same_slug_count > 1) ? '-' . $same_slug_count + 1 : '';
        $slug                   .= $slug_suffix;

        $category->slug         = $slug;
        $category->save();

        
        // if($old_category != $request->parent_id){
        //     $main_category = $category->id;
        //     if($category->parent_id != 0){
        //         $main_category = $category->getMainCategory();
        //     }
        //     Product::where('category_id',$category->id)->update(['main_category' => $main_category]);
        // }

        Artisan::call('cache:clear');
        flash(translate('Category has been updated successfully'))->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->attributes()->detach();

        // Category Translations Delete
        foreach ($category->category_translations as $key => $category_translation) {
            $category_translation->delete();
        }

        foreach (Product::where('category_id', $category->id)->get() as $product) {
            $product->category_id = null;
            $product->save();
        }

        CategoryUtility::delete_category($id);
        Cache::forget('featured_categories');

        flash(translate('Category has been deleted successfully'))->success();
        return redirect()->route('categories.index');
    }

    public function updateFeatured(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->featured = $request->status;
        $category->save();
        Cache::forget('featured_categories');
        Artisan::call('cache:clear');
        return 1;
    }

    public function updateStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->is_active = $request->status;
        $category->save();
        $category->childrenCategories()->update(['is_active' => $request->status]);
        // Cache::forget('featured_categories');
        Artisan::call('cache:clear');
        return 1;
    }
}
