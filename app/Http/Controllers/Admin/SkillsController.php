<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Http\Requests\SkillsRequest;

class SkillsController extends Controller
{
    
    public function store(SkillsRequest $request)
    {
        Skill::create($request->validated());
        return back()->with('success', 'تمت إضافة المهارة بنجاح');
    }

    public function update(SkillsRequest $request, Skill $skill)
    {
        $skill->update($request->validated());
        return back()->with('success', 'تم تعديل المهارة بنجاح');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'تم حذف المهارة');
    }

    public function toggle(Skill $skill)
    {
        $skill->is_active = !$skill->is_active;
        $skill->save();
        return back()->with('success', 'تم تغيير حالة المهارة');
    }
}
