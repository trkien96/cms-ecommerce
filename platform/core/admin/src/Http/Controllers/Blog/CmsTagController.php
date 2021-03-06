<?php


namespace Core\Admin\Http\Controllers\Blog;


use App\Http\Requests\AdminTagRequest;
use App\Models\Blog\Menu;
use App\Models\Blog\Tag;
use Carbon\Carbon;
use Core\Admin\Http\Controllers\CmsAdminController;
use Illuminate\Http\Request;

class CmsTagController extends CmsAdminController
{
    public function index()
    {
        $tags = Tag::orderByDesc('id')->paginate(20);
        $viewData = [
            'tags' => $tags
        ];
        return view('admin::pages.blog.tag.index', $viewData);
    }

    public function create()
    {
        return view('admin::pages.blog.tag.create');
    }

    public function store(AdminTagRequest $request)
    {
        $data               = $request->except('_token');
        $data['created_at'] = Carbon::now();
        $id                 = Tag::insertGetId($data);
        if ($id) {
            $this->showSuccessMessages();
            return redirect()->back();
        }
        $this->showErrorMessages();
        return  redirect()->back();
    }

    public function edit($id)
    {
        $tag = Tag::findOrfail($id);
        return view('admin::pages.blog.tag.update', compact('tag'));
    }

    public function update(AdminTagRequest $request, $id)
    {
        $data               = $request->except('_token');
        $data['updated_at'] = Carbon::now();
        Tag::findOrFail($id)->update($data);
        $this->showSuccessMessages('Cập nhật dữ liệu thành công');
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()){
            Tag::find($id)->delete();
            return response()->json([
                'code' => 200
            ]);
        }
    }
}
