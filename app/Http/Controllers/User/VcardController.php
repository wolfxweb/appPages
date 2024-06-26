<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\UserVcard;
use App\Models\User\UserVcardProject;
use App\Models\User\UserVcardService;
use App\Models\User\UserVcardTestimonial;
use Auth;
use Illuminate\Http\Request;
use Session;
use Validator;

class VcardController extends Controller
{
    public function vcard()
    {
        $data['vcards'] = UserVcard::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('user.vcard.index', $data);
    }

    public function create()
    {
        return view('user.vcard.create');
    }

    public function edit($id)
    {
        $data['vcard'] = UserVcard::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();
        return view('user.vcard.edit', $data);
    }

    public function services($id)
    {
        $vcard = UserVcard::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();;
        $services = $vcard->user_vcard_services()->orderBy('id', 'DESC')->get();

        $data['vcard'] = $vcard;
        $data['services'] = $services;

        return view('user.vcard.services.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function serviceStore(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');
        $messages = [
            'title.required' => 'O campo título é obrigatório',
            'serial_number.required' => 'O campo do número de série é obrigatório',
            'image.required' => 'O campo da imagem é obrigatório',
        ];


        $rules = [
            'user_vcard_id' => 'required',
            'title' => 'required|max:255',
            'serial_number' => 'required|integer',
            'image' => [
                'required',
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Somente imagens png, jpg, jpeg são permitidas");
                        }
                    }
                },
            ],
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $input = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $directory = public_path('assets/front/img/user/services/');
            if (!file_exists($directory)) mkdir($directory, 0775, true);
            $request->file('image')->move($directory, $filename);
            $input['image'] = $filename;
        }
        $input['user_vcard_id'] = $request->user_vcard_id;
        $service = new UserVcardService();
        $service->create($input);

        Session::flash('success', 'Serviço adicionado com sucesso!');
        return "success";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function serviceUpdate(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $messages = [
            'title.required' => 'O campo título é obrigatório',
            'serial_number.required' => 'O campo do número de série é obrigatório',
        ];

        $rules = [
            'title' => 'required|max:255',
            'serial_number' => 'required|integer',
            'image' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Somente imagens png, jpg, jpeg são permitidas");
                        }
                    }
                },
            ],
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $service = UserVcardService::findOrFail($request->service_id);
        if ($service->user_vcard->user_id != Auth::user()->id) {
            return;
        }
        $input = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/front/img/user/services/'), $filename);
            if (file_exists(public_path('assets/front/img/user/services/' . $service->image))) {
                @unlink(public_path('assets/front/img/user/services/' . $service->image));
            }

            $input['image'] = $filename;
        }
        $service->update($input);

        Session::flash('success', 'Serviço atualizado com sucesso!');
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function serviceDelete(Request $request)
    {
        $service = UserVcardService::findOrFail($request->service_id);
        @unlink(public_path('assets/front/img/user/services/' . $service->image));
        $service->delete();
        Session::flash('success', 'Serviço excluído com sucesso!');
        return back();
    }

    public function bulkServiceDelete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $service = UserVcardService::findOrFail($id);
            @unlink(public_path('assets/front/img/user/services/' . $service->image));
            $service->delete();
        }
        Session::flash('success', 'Serviços excluídos com sucesso!');
        return "success";
    }

    public function store(Request $request)
    {
        $profileImg = $request->file('profile_image');
        $coverImg = $request->file('cover_image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'vcard_name' => 'required|max:255',
            'template' => 'required',
            'direction' => 'required',
            'name' => 'nullable|max:255',
            'occupation' => 'nullable|max:255',
            'profile_image' => [
                
                function ($attribute, $value, $fail) use ($profileImg, $allowedExts) {
                    if (!empty($profileImg)) {
                        $ext = $profileImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Somente imagens png, jpg, jpeg são permitidas");
                        }
                        $size = $profileImg->getSize();
                        if ($size > 200000) {
                            return $fail("O tamanho da imagem não pode ser maior que 200 KB");
                        }
                    }
                },
            ],
            'cover_image' => [
                function ($attribute, $value, $fail) use ($coverImg, $allowedExts) {
                    if (!empty($coverImg)) {
                        $ext = $coverImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Somente imagens png, jpg, jpeg são permitidas");
                        }
                    }
                },
            ],
            'icons.*' => 'required',
            'colors.*' => 'required',
            'labels.*' => 'required',
            'values.*' => 'required',
        ];

        $messages = [
            'icons.*.required' => 'O campo Ícone não pode estar vazio',
            'colors.*.required' => 'O campo cor não pode estar vazio',
            'labels.*.required' => 'O campo lables não pode estar vazio',
            'values.*.required' => 'O campo valores não pode estar vazio',
            'vcard_name'=>'O campo nome da página não pode estar vazio '
            
        ];


        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $vcard = new UserVcard();
        $vcard->user_id = Auth::user()->id;
        $vcard->vcard_name = $request->vcard_name;
        $vcard->direction = $request->direction;
        $vcard->template = $request->template;
        if ($request->hasFile('profile_image')) {
            $filename = uniqid() . '.' . $profileImg->getClientOriginalExtension();
            $dir = public_path('assets/front/img/user/vcard/');
            @mkdir($dir, 0775, true);
            $request->file('profile_image')->move($dir, $filename);
            $vcard->profile_image = $filename;
        }
        if ($request->hasFile('cover_image')) {
            $filename = uniqid() . '.' . $coverImg->getClientOriginalExtension();
            $dir = public_path('assets/front/img/user/vcard/');
            @mkdir($dir, 0775, true);
            $request->file('cover_image')->move($dir, $filename);
            $vcard->cover_image = $filename;
        }
        $vcard->name = $request->name;
        $vcard->occupation = $request->occupation;
        $vcard->company = $request->company;
        $vcard->email = $request->email;
        $vcard->phone = $request->phone;
        $vcard->address = $request->address;
        $vcard->website_url = $request->website_url;
        $vcard->introduction = $request->introduction;

        // language keywords
        $data = file_get_contents(resource_path('lang/') . 'vcard.json');
        $vcard->keywords = $data;

        $vcard->preferences = '["Call","Whatsapp","Mail","Add to Contact","Share vCard","Information","About Us","Video","Services","Projects","Testimonials","Enquiry Form","Header"]';

        $infoArr = [];
        $labels = $request->labels ? $request->labels : [];
        $values = $request->values ? $request->values : [];
        $icons = $request->icons ? $request->icons : [];
        $colors = $request->colors ? $request->colors : [];
        $links = $request->links ? $request->links : [];

        foreach ($labels as $key => $label) {
            $info = [
                'icon' => $icons["$key"],
                'color' => $colors["$key"],
                'label' => $labels["$key"],
                'link' => in_array($key, $links) ? 1 : 0,
                'value' => $values["$key"]
            ];
            $infoArr[] = $info;
        }

        $vcard->information = json_encode($infoArr);

        $vcard->session_page_order_1 = 'header';
        $vcard->session_page_order_2 = 'informacoes';
        $vcard->session_page_order_3 = 'sobre_nos';
        $vcard->session_page_order_4 = 'servicos';
        $vcard->session_page_order_5 = 'projetos';
        $vcard->session_page_order_6 = 'video';
        $vcard->session_page_order_7 = 'depoimentos';
        $vcard->session_page_order_8 = 'formulario';
        $vcard->session_page_order_9 = 'mapa';

        $vcard->google_maps = $request->google_maps;




     /*   $order[0]['header'] = "0";
        $order[1]['informacoes'] = "1";
        $order[2]['sobre_nos'] = "2";
        $order[3]['servicos'] = "3";
        $order[4]['projetos'] = "4";
        $order[5]['video'] = "5";
        $order[6]['depoimentos'] = "6";
        $order[7]['formulario'] = "7";
        $order[6]['formulario'] = $request->session_page_order_8 ;
        $vcard->page_order =  json_encode($order);*/
                $vcard->save();
     
        $this->preferences($vcard->id);
        $request->session()->flash('success', 'Página cadastrada com sucesso');
        return 'success';
    }

    public function update(Request $request)
    {
        $profileImg = $request->file('profile_image');
        $coverImg = $request->file('cover_image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'vcard_name' => 'required|max:255',
            'template' => 'required',
            'direction' => 'required',
            'name' => 'nullable|max:255',
            'occupation' => 'nullable|max:255',
            'profile_image' => [
                function ($attribute, $value, $fail) use ($profileImg, $allowedExts) {
                    if (!empty($profileImg)) {
                        $ext = $profileImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Somente imagens png, jpg, jpeg são permitidas");
                        }
                        $size = $profileImg->getSize();
                        if ($size > 200000) {
                            return $fail("O tamanho da imagem não pode ser maior que 200 KB");
                        }
                    }
                },
            ],
            'cover_image' => [
                function ($attribute, $value, $fail) use ($coverImg, $allowedExts) {
                    if (!empty($coverImg)) {
                        $ext = $coverImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Somente imagens png, jpg, jpeg são permitidas");
                        }
                    }
                },
            ],
            'icons.*' => 'required',
            'colors.*' => 'required',
            'labels.*' => 'required',
            'values.*' => 'required',
        ];

        $messages = [
            'icons.*.required' => 'O campo Ícone não pode estar vazio',
            'colors.*.required' => 'O campo Cor não pode estar vazio',
            'labels.*.required' => 'O campo Rótulo não pode estar vazio',
            'values.*.required' => 'O campo Valor não pode estar vazio'
        ];


        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $vcard = UserVcard::find($request->vcard_id);

        if ($vcard->user_id != Auth::user()->id) {
            return;
        }

        $vcard->user_id = Auth::user()->id;
        $vcard->vcard_name = $request->vcard_name;
        $vcard->direction = $request->direction;
        $vcard->template = $request->template;
        if ($request->hasFile('profile_image')) {
            $filename = uniqid() . '.' . $profileImg->getClientOriginalExtension();
            $dir = public_path('assets/front/img/user/vcard/');
            @mkdir($dir, 0775, true);
            $request->file('profile_image')->move($dir, $filename);
            $vcard->profile_image = $filename;
        }
        if ($request->hasFile('cover_image')) {
            $filename = uniqid() . '.' . $coverImg->getClientOriginalExtension();
            $dir = public_path('assets/front/img/user/vcard/');
            @mkdir($dir, 0775, true);
            $request->file('cover_image')->move($dir, $filename);
            $vcard->cover_image = $filename;
        }
        $vcard->name = $request->name;
        $vcard->occupation = $request->occupation;
        $vcard->company = $request->company;
        $vcard->email = $request->email;
        $vcard->phone = $request->phone;
        $vcard->address = $request->address;
        $vcard->website_url = $request->website_url;
        $vcard->introduction = $request->introduction;
        $vcard->google_maps = $request->google_maps;

      /*  $vcard->call_button_color = $request->call_button_color ? ltrim($request->call_button_color, '#')  : "ed2476";
        $vcard->whatsapp_button_color = $request->whatsapp_button_color ? ltrim($request->whatsapp_button_color, '#')  : "ed2476";
        $vcard->mail_button_color = $request->mail_button_color ? ltrim($request->mail_button_color, '#')  : "ed2476";
        $vcard->add_to_contact_button_color = $request->add_to_contact_button_color ? ltrim($request->add_to_contact_button_color, '#')  : "ed2476";
        $vcard->share_vcard_button_color = $request->share_vcard_button_color ? ltrim($request->share_vcard_button_color, '#')  : "ed2476";
        $vcard->phone_icon_color = $request->phone_icon_color ? ltrim($request->phone_icon_color, '#')  : "ed2476";
        $vcard->email_icon_color = $request->email_icon_color ? ltrim($request->email_icon_color, '#')  : "ed2476";
        $vcard->address_icon_color = $request->address_icon_color ? ltrim($request->address_icon_color, '#')  : "ed2476";
        $vcard->website_url_icon_color = $request->website_url_icon_color ? ltrim($request->website_url_icon_color, '#')  : "ed2476";
        $vcard->base_color = $request->base_color ? ltrim($request->base_color, '#')  : "ed2476";
        $vcard->summary_background_color = $request->summary_background_color ? ltrim($request->summary_background_color, '#')  : "ed2476";
        $vcard->page_background_color = $request->page_background_color ? ltrim($request->page_background_color, '#')  : "ed2476";
*/


        $infoArr = [];
        $labels = $request->labels ? $request->labels : [];
        $values = $request->values ? $request->values : [];
        $icons = $request->icons ? $request->icons : [];
        $colors = $request->colors ? $request->colors : [];
        $links = $request->links ? $request->links : [];

        foreach ($labels as $key => $label) {
            $info = [
                'icon' => $icons["$key"],
                'color' => $colors["$key"],
                'label' => $labels["$key"],
                'link' => in_array($key, $links) ? 1 : 0,
                'value' => $values["$key"]
            ];
            $infoArr[] = $info;
        }

        $vcard->information = json_encode($infoArr);

        $vcard->save();

        $request->session()->flash('success', 'Página atualizada com sucesso');
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $vcard = UserVcard::where('user_id', Auth::user()->id)->where('id', $request->vcard_id)->firstOrFail();
        @unlink(public_path('assets/front/img/user/vcard/' . $vcard->profile_image));
        @unlink(public_path('assets/front/img/user/vcard/' . $vcard->cover_image));
        $vcard->delete();
        Session::flash('success', 'Página excluida com sucesso!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $vcard = UserVcard::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();
            @unlink(public_path('assets/front/img/user/vcard/' . $vcard->profile_image));
            @unlink(public_path('assets/front/img/user/vcard/' . $vcard->cover_image));
            $vcard->delete();
        }
        Session::flash('success', 'Página excluida com sucesso!');
        return "success";
    }

    public function information($id)
    {
        $vcard = UserVcard::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();;
        $information = json_decode($vcard->information, true);
        return response()->json($information);
    }

    public function projects($id)
    {
        $vcard = UserVcard::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();;
        $projects = $vcard->user_vcard_projects()->orderBy('id', 'DESC')->get();

        $data['vcard'] = $vcard;
        $data['projects'] = $projects;

        return view('user.vcard.projects.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function projectStore(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');
        $messages = [
            'title.required' => 'O campo título é obrigatório',
            'serial_number.required' => 'O campo do número de série é obrigatório',
            'image.required' => 'O campo da imagem é obrigatório',
        ];


        $rules = [
            'user_vcard_id' => 'required',
            'title' => 'required|max:255',
            'serial_number' => 'required|integer',
            'image' => [
                'required',
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Somente imagens png, jpg, jpeg são permitidas");
                        }
                    }
                },
            ],
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $input = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $directory = public_path('assets/front/img/user/projects/');
            if (!file_exists($directory)) mkdir($directory, 0775, true);
            $request->file('image')->move($directory, $filename);
            $input['image'] = $filename;
        }
        $input['user_vcard_id'] = $request->user_vcard_id;
        $project = new UserVcardProject();
        $project->create($input);

        Session::flash('success', 'Projeto adicionado com sucesso!');
        return "success";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function projectUpdate(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $messages = [
            'title.required' => 'O campo título é obrigatório',
            'serial_number.required' => 'O campo do número de série é obrigatório',
        ];

        $rules = [
            'title' => 'required|max:255',
            'serial_number' => 'required|integer',
            'image' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Somente imagens png, jpg, jpeg são permitidas");
                        }
                    }
                },
            ],
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $project = UserVcardProject::findOrFail($request->project_id);
        if ($project->user_vcard->user_id != Auth::user()->id) {
            return;
        }
        $input = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/front/img/user/projects/'), $filename);
            if (file_exists(public_path('assets/front/img/user/projects/' . $project->image))) {
                @unlink(public_path('assets/front/img/user/projects/' . $project->image));
            }

            $input['image'] = $filename;
        }
        $project->update($input);

        Session::flash('success', 'Projeto atualizado com sucesso!');
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function projectDelete(Request $request)
    {
        $project = UserVcardProject::findOrFail($request->project_id);
        @unlink(public_path('assets/front/img/user/projects/' . $project->image));
        $project->delete();
        Session::flash('success', 'Projeto excluído com sucesso!');
        return back();
    }

    public function bulkProjectDelete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $project = UserVcardProject::findOrFail($id);
            @unlink(public_path('assets/front/img/user/projects/' . $project->image));
            $project->delete();
        }
        Session::flash('success', 'Projeto excluído com sucesso!');
        return "success";
    }

    public function testimonials($id)
    {
        $vcard = UserVcard::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();
        $testimonials = $vcard->user_vcard_testimonials()->orderBy('id', 'DESC')->get();

        $data['vcard'] = $vcard;
        $data['testimonials'] = $testimonials;

        return view('user.vcard.testimonials.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function testimonialStore(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');
        $messages = [
            'name.required' => 'O campo nome é obrigatório',
            'serial_number.required' => 'O campo do número de série é obrigatório',
            'image.required' => 'O campo da imagem é obrigatório',
        ];


        $rules = [
            'user_vcard_id' => 'required',
            'name' => 'required|max:255',
            'serial_number' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable',
            'image' => [
                'required',
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Somente imagens png, jpg, jpeg são permitidas");
                        }
                    }
                },
            ],
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $input = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $directory = public_path('assets/front/img/user/testimonials/');
            if (!file_exists($directory)) mkdir($directory, 0775, true);
            $request->file('image')->move($directory, $filename);
            $input['image'] = $filename;
        }
        $input['user_vcard_id'] = $request->user_vcard_id;
        $testimonial = new UserVcardTestimonial();
        $testimonial->create($input);

        Session::flash('success', 'Testemunho adicionado com sucesso!');
        return "success";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function testimonialUpdate(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'name' => 'required|max:255',
            'serial_number' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable',
            'image' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Somente imagens png, jpg, jpeg são permitidas");
                        }
                    }
                },
            ],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $testimonial = UserVcardTestimonial::findOrFail($request->testimonial_id);
        if ($testimonial->user_vcard->user_id != Auth::user()->id) {
            return;
        }
        $input = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/front/img/user/testimonials/'), $filename);
            if (file_exists(public_path('assets/front/img/user/testimonials/' . $testimonial->image))) {
                @unlink(public_path('assets/front/img/user/testimonials/' . $testimonial->image));
            }

            $input['image'] = $filename;
        }
        $testimonial->update($input);

        Session::flash('success', 'Depoimento atualizado com sucesso!');
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function testimonialDelete(Request $request)
    {
        $testimonial = UserVcardTestimonial::findOrFail($request->testimonial_id);
        @unlink(public_path('assets/front/img/user/testimonials/' . $testimonial->image));
        $testimonial->delete();
        Session::flash('success', 'Depoimento atualizado com sucesso!');
        return back();
    }

    public function bulkTestimonialDelete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $testimonial = UserVcardTestimonial::findOrFail($id);
            @unlink(public_path('assets/front/img/user/testimonials/' . $testimonial->image));
            $testimonial->delete();
        }
        Session::flash('success', 'Depoimentos excluídos com sucesso!');
        return "success";
    }

    public function about($id)
    {
        $data['vcard'] = UserVcard::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();
        return view('user.vcard.about', $data);
    }

    public function aboutUpdate(Request $request)
    {

        $vcard = UserVcard::find($request->vcard_id);
        if ($vcard->user_id != Auth::user()->id) {
            return;
        }
        $vcard->video = $request->video;
        $vcard->about = clean($request->about);
        $vcard->save();

        $request->session()->flash('success', 'Sobre e vídeo atualizado com sucesso');
        return 'success';
    }

    public function preferences($id)
    {
        $vcard = UserVcard::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();

        $preferences = [];
        if (!empty($vcard->preferences)) {
            $preferences = json_decode($vcard->preferences, true);
        }


        $page_order = json_decode($vcard->page_order, true);
        if(empty($page_order)){
            $page_order[0]['header']=1;
            $page_order[1]['informacoes']=2;
            $page_order[2]['sobre_nos']=3;
            $page_order[3]['servicos']=4;
            $page_order[4]['projetos']=5;
            $page_order[5]['video']=6;
            $page_order[6]['depoimentos']=7;
            $page_order[7]['formulario']=8;
            $page_order[8]['mapa']=9;
           }
        $data['vcard'] = $vcard;
        $data['preferences'] = $preferences;
        $data['page_order'] = $page_order;

        return view('user.vcard.preferences', $data);
    }

    public function prefUpdate(Request $request, $vcId)
    {
        $dat = $request;
        $vcard = UserVcard::findOrFail($vcId);

        if ($vcard->user_id != Auth::user()->id) {
            return;
        }

        $preferences = $request->preferences;


        $vcard->session_page_order_1 = $this->getNameSession($request->session_page_order_1);
        $vcard->session_page_order_2 = $this->getNameSession($request->session_page_order_2);
        $vcard->session_page_order_3 = $this->getNameSession($request->session_page_order_3);
        $vcard->session_page_order_4 = $this->getNameSession($request->session_page_order_4);
        $vcard->session_page_order_5 = $this->getNameSession($request->session_page_order_5);
        $vcard->session_page_order_6 = $this->getNameSession($request->session_page_order_6);
        $vcard->session_page_order_7 = $this->getNameSession($request->session_page_order_7);
        $vcard->session_page_order_8 = $this->getNameSession($request->session_page_order_8);
        $vcard->session_page_order_9 = $this->getNameSession($request->session_page_order_9);

        $order[0]['header'] = $request->session_page_order_1;
        $order[1]['informacoes'] = $request->session_page_order_2;
        $order[2]['sobre_nos'] = $request->session_page_order_3;
        $order[3]['servicos'] = $request->session_page_order_4;
        $order[4]['projetos'] = $request->session_page_order_5;
        $order[5]['video'] = $request->session_page_order_6;
        $order[6]['depoimentos'] = $request->session_page_order_7;
        $order[7]['formulario'] = $request->session_page_order_8;
        $order[8]['mapa'] = $request->session_page_order_9;
        $vcard->google_analitics =htmlspecialchars($request->google_analitics);
        $vcard->pixel_facebook =htmlspecialchars($request->pixel_facebook);
        $vcard->font_title =$request->font_title;
        $vcard->font_color =$request->font_color;
        $vcard->font_title_size =$request->font_title_size;
        $vcard->font_color_content =$request->font_color_content;
        $vcard->font_content =$request->font_content;
        $vcard->font_content_size =$request->font_content_size;
       
       // dd($request);
        // $order[6]['formulario'] = $request->session_page_order_8 ;
        $vcard->page_order =  json_encode($order);
        if (empty($preferences)) {
            $vcard->preferences = NULL;
        } else {
            $vcard->preferences = json_encode($preferences);
        }
        $vcard->save();

        $request->session()->flash('success', 'Preferências atualizadas com sucesso!');
        return 'success';
    }
    public function getNameSession($id)
    {
        $nameSession = '';
        switch ($id) {
            case "1":
                $nameSession = 'header';
                break;
            case "2":
                $nameSession = 'informacoes';
                break;
            case "3":
                $nameSession = 'sobre_nos';
                break;
            case "4":
                $nameSession = 'servicos';
                break;
            case "5":
                $nameSession = 'projetos';
                break;
            case "6":
                $nameSession = 'video';
                break;
            case "7":
                $nameSession = 'depoimentos';
                break;
            case "8":
                $nameSession = 'formulario';
                break;
           case "9":
                    $nameSession = 'mapa';
                    break;
            default:
                $nameSession = 'informacoes';
        }
        return $nameSession;
    }
    public function color($id)
    {
        $vcard = UserVcard::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();
        $data['vcard'] = $vcard;

        return view('user.vcard.color', $data);
    }

    public function colorUpdate(Request $request, $vcId)
    {
        $vcard = UserVcard::findOrFail($vcId);

        if ($vcard->user_id != Auth::user()->id) {
            return;
        }

        $vcard->base_color = $request->base_color;

        if ($vcard->template == 6) {
            $vcard->summary_background_color = $request->summary_background_color;
        }

        if ($vcard->template != 5 && $vcard->template != 6 && $vcard->template != 9 && $vcard->template != 10) {
            $vcard->call_button_color = $request->call_button_color;
            $vcard->whatsapp_button_color = $request->whatsapp_button_color;
            $vcard->mail_button_color = $request->mail_button_color;
            $vcard->add_to_contact_button_color = $request->add_to_contact_button_color;
            $vcard->share_vcard_button_color = $request->share_vcard_button_color;
            $vcard->phone_icon_color = $request->phone_icon_color;
            $vcard->email_icon_color = $request->email_icon_color;
            $vcard->address_icon_color = $request->address_icon_color;
            $vcard->website_url_icon_color = $request->website_url_icon_color;
            $vcard->summary_background_color = $request->summary_background_color;
            $vcard->page_background_color = $request->page_background_color;
        }

        $vcard->save();

        $request->session()->flash('success', 'Cores atualizadas com sucesso');
        return 'success';
    }

    public function keywords($id)
    {
        $vcard = UserVcard::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();
        $keywords = [];
        if (!empty($vcard->keywords)) {
            $keywords = json_decode($vcard->keywords, true);
        }

        $data['vcard'] = $vcard;
        $data['keywords'] = $keywords;

        return view('user.vcard.keywords', $data);
    }

    public function keywordsUpdate(Request $request, $vcId)
    {
        $keywords = $request->except("_token");
        if (empty($keywords)) {
            $keywords = [];
        }

        $upKeywords = [];
        foreach ($keywords as $key => $value) {
            $upKeywords["$key"] = $value;
        }
        $upKeywords = json_encode($upKeywords);

        $vcard = UserVcard::findOrFail($vcId);
        if ($vcard->user_id != Auth::user()->id) {
            return;
        }
        $vcard->keywords = $upKeywords;
        $vcard->save();

        $request->session()->flash('success', 'Atualizado com sucesso!');
        return 'success';
    }
}
