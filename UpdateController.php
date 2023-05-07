<?php

namespace App\Http\Controllers;

use App\Models\BasicExtended;
use Illuminate\Support\Facades\Schema;
use App\Models\Language;
use App\Models\User\Language as UserLanguage;
use App\Models\User\UserPermission;
use App\Models\User\UserVcard;
use Illuminate\Http\Request;
use Artisan;
use DB;

class UpdateController extends Controller
{
    public function version()
    {
        return view('updater.version');
    }

    public function filesFolders($src, $des) {
        $dir = $src;//"path/to/targetFiles";
        $dirNew = $des;//path/to/destination/files
        // Open a known directory, and proceed to read its contents
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                echo '<br>Archivo: '.$file;
                //exclude unwanted 
                if ($file=="move.php")continue;
                if ($file==".") continue;
                if ($file=="..")continue;
                if ($file=="viejo2014")continue;
                if ($file=="viejo2013")continue;
                if ($file=="cgi-bin")continue;
                //if ($file=="index.php") continue; for example if you have index.php in the folder
    
                if (rename($dir.'/'.$file,$dirNew.'/'.$file))
                    {
                    echo " Files Copyed Successfully";
                    echo ": $dirNew/$file"; 
                    //if files you are moving are images you can print it from 
                    //new folder to be sure they are there 
                    }
                    else {echo "File Not Copy";}
                }
                closedir($dh);
            }
        }
    }

    public function recurse_copy($src, $dst)
    {

        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    @copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function upversion(Request $request)
    {

        $assets = array(
            ['path' => 'assets/admin/js', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'assets/admin/css', 'type' => 'folder', 'action' => 'replace'],

            ['path' => 'assets/front/css', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'assets/front/js', 'type' => 'folder', 'action' => 'replace'],
            // ['path' => 'assets/front/img', 'type' => 'folder', 'action' => 'add'],

            ['path' => 'config', 'type' => 'folder', 'action' => 'replace'],
            // ['path' => 'database/migrations', 'type' => 'folder', 'action' => 'add'],
            ['path' => 'resources/views', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'resources/profile', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'routes/web.php', 'type' => 'file', 'action' => 'replace'],
            ['path' => 'app', 'type' => 'folder', 'action' => 'replace'],

            ['path' => 'composer.json', 'type' => 'file', 'action' => 'replace'],
            ['path' => 'composer.lock', 'type' => 'file', 'action' => 'replace'],
            ['path' => 'version.json', 'type' => 'file', 'action' => 'replace']
        );

        foreach ($assets as $key => $asset) {
            $des = '';
            
            if(strpos($asset["path"], 'assets/') !== false){
                $des = 'public/' . $asset["path"];
            } else{
                $des = $asset["path"];
            }

            // if 'resources/views/user/profile' folder exists, only then replace it.
            // otherwise, skip it
            if ($asset['path'] == 'resources/profile') {
                $profile = file_exists('resources/views/user/profile');
                if ($profile) {
                    @unlink('resources/views/user/profile');
                    $this->recurse_copy('public/updater/' . 'resources/profile', 'resources/views/user/profile');
                }
                continue;
            }
            // if updater need to replace files / folder (with/without content)
            if ($asset['action'] == 'replace') {
                if ($asset['type'] == 'file') {
                    @copy('public/updater/' . $asset["path"], $des);
                }
                if ($asset['type'] == 'folder') {
                    @unlink($des);
                    $this->recurse_copy('public/updater/' . $asset["path"], $des);
                }
            }
            // if updater need to add files / folder (with/without content)
            elseif ($asset['action'] == 'add') {
                if ($asset['type'] == 'folder') {
                    @mkdir($des . '/', 0775, true);
                    $this->recurse_copy('public/updater/' . $asset["path"], $des);
                }
            }
        }

        $arr = ['WEBSITE_HOST' => $request->website_host];
        setEnvironmentValue($arr);


        // $this->updateLanguage();

        Artisan::call('config:clear');
        // run migration files
        // Artisan::call('migrate');

        // $vcards = UserVcard::all();
        // $newKeys = ["Share_On"=>"Share On","Facebook"=>"Facebook","Linkedin"=>"Linkedin","Twitter"=>"Twitter","SMS"=>"SMS"];
        // foreach ($vcards as $key => $vcard) {

        //     $keyArr = json_decode($vcard->keywords, true);
        //     foreach ($newKeys as $key => $newKey) {
        //         $keyArr["$key"] = $newKey;
        //     }
        //     $vcard->keywords = json_encode($keyArr);

        //     $vcard->save();
        // }


        // // read vcard json file
        // $data = file_get_contents('core/resources/lang/vcard.json');
        // // decode default json
        // $json_arr = json_decode($data, true);
        // // new keys
        // foreach ($newKeys as $key => $newKey) {
        //     // # code...
        //     if (!array_key_exists($key, $json_arr)) {
        //         $json_arr[$key] = $newKey;
        //     }
        // }
        // // push the new key-value pairs in vcard json files
        // file_put_contents('core/resources/lang/vcard.json', json_encode($json_arr));


        // $permissions = UserPermission::all();
        // $newPermissions = ["Footer Mail","Profile Listing"];
        // foreach ($permissions as $key => $permission) {

        //     $permissionArr = json_decode($permission->permissions, true);
        //     foreach ($newPermissions as $key => $newPer) {
        //         $permissionArr[] = $newPer;
        //     }
        //     $permission->permissions = json_encode($permissionArr);

        //     $permission->save();
        // }


        // $langs = UserLanguage::all();
        // $newKeys = ["I_am"=>"I am","About"=>"About","Enter_Email_Address"=>"Enter Email Address","Enter_Name"=>"Enter Name","Enter_Subject"=>"Enter Subject","Enter_Message"=>"Enter Message","Testimonial"=>"Testimonial","Experience"=>"Experience","Present"=>"Present"];
        // foreach ($langs as $key => $lang) {

        //     $keyArr = json_decode($lang->keywords, true);
        //     foreach ($newKeys as $key => $newKey) {
        //         $keyArr["$key"] = $newKey;
        //     }
        //     $lang->keywords = json_encode($keyArr);

        //     $lang->save();
        // }

        // DB::table('email_templates')->insert([
        //     ['email_type' => 'admin_changed_current_package', 'email_subject' => 'Admin has changed your current package'],
        //     ['email_type' => 'admin_added_current_package', 'email_subject' => 'Admin has added current package for you'],
        //     ['email_type' => 'admin_changed_next_package', 'email_subject' => 'Admin has changed your next package'],
        //     ['email_type' => 'admin_added_next_package', 'email_subject' => 'Admin has added next package for you'],
        //     ['email_type' => 'admin_removed_current_package', 'email_subject' => 'Admin has removed current package for you'],
        //     ['email_type' => 'admin_removed_next_package', 'email_subject' => 'Admin has removed your next package'],
        // ]);

        // @unlink('index.php');
        // @copy('updater/core/index.php', 'index.php');


        \Session::flash('success', 'Updated successfully');
        return redirect('public/updater/success.php');
    }

    function delete_directory($dirname)
    {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    $this->delete_directory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    public function updateLanguage()
    {
        $langCodes = [];
        $languages = Language::all();
        foreach ($languages as $key => $language) {
            $langCodes[] = $language->code;
        }
        $langCodes[] = 'default';

        foreach ($langCodes as $key => $langCode) {
            // read language json file
            $data = file_get_contents('core/resources/lang/' . $langCode . '.json');

            // decode default json
            $json_arr = json_decode($data, true);


            // new keys
            $newKeywordsJson = file_get_contents('updater/language.json');
            $newKeywords = json_decode($newKeywordsJson, true);
            foreach ($newKeywords as $key => $newKeyword) {
                // # code...
                if (!array_key_exists($key, $json_arr)) {
                    $json_arr[$key] = $key;
                }
            }

            // push the new key-value pairs in language json files
            file_put_contents('core/resources/lang/' . $langCode . '.json', json_encode($json_arr));
        }
    }

    public function redirectToWebsite(Request $request) {
        $arr = ['WEBSITE_HOST' => $request->website_host];
        setEnvironmentValue($arr);
        \Artisan::call('config:clear');

        return redirect()->route('front.index');
    }
}
