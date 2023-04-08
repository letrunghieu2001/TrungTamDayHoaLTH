<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnnouncementRequest;
use App\Http\Requests\CreateNewsRequest;
use App\Models\ChemistryClass;
use App\Models\ClassAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassAnnouncementController extends Controller
{
    public function store(CreateAnnouncementRequest $request, ChemistryClass $class)
    {
        $content = $request->content;
        $dom = new \DomDocument();
        @$dom->loadHtml('<?xml encoding="utf-8" ?>' .$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);

            $image_name = "/upload/" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }


        $content = $dom->saveHTML();

        $data = ClassAnnouncement::create([
            'content' => $content,
            'user_id' => Auth::user()->id,
            'class_id' => $class->id
        ]);

        return back()->with('succes', 'Tạo mới thông báo thành công');
    }

    public function update(Request $request, ClassAnnouncement $announcement)
    {
        $input = $request->editContent;
        $dom = new \DomDocument();
        @$dom->loadHtml('<?xml encoding="utf-8" ?>' .$input, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );

        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);

            $image_name = "/upload/" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        $input = $dom->saveHTML();

        ClassAnnouncement::where('id', $announcement->id)->update([
            'content' => $input,
        ]);

        return back();
    }

    public function destroy(ClassAnnouncement $announcement, ChemistryClass $class)
    {
        $announcement->delete();
        return redirect()->route('class.show', [$class->id]);
    }
}
