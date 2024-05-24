<?php
    $address = $_GET['address'];
    $type = $_GET['type'];
    $ouput;
    $type == "비디오" ? save_vid() : save_aud();
    //$target_Dir = "다운받을 파일이 있는 폴더명";
    //$down = $target_Dir.$file;
    $filesize = filesize($file);
    function save_vid(){
        global $address;
        global $type;
        $v_cmd =sprintf('yt-dlp.exe -o temp_vedio.%%(ext)s %s',$address);;
        exec($v_cmd);
        sleep(2);
        save_del("temp_video.mp4");
    }
    function save_aud(){
        global $address;
        global $type;
        $a_cmd =sprintf('yt-dlp.exe -x --audio-format mp3 -o temp_audio.%%(ext)s %s',$address);;
        exec($a_cmd);
        sleep(2);
        save_del("temp_audio.webm");
    }
    function save_del($file){
        if(file_exists($file)){
            header("Content-Type:application/octet-stream");
            header("Content-Disposition:attachment;filename=$file");
            header("Content-Transfer-Encoding:binary");
            header("Content-Length:".filesize($target_Dir.$file));
            header("Cache-Control:cache,must-revalidate");
            header("Pragma:no-cache");
            header("Expires:0");
            if(is_file($file)){
                $fp = fopen($file,"r");
                while(!feof($fp)){
                $buf = fread($fp,8096);
                $read = strlen($buf);
                print($buf);
                flush();
                }
                unlink($file);
                fclose($fp);
            }
        } else{
            echo "존재하지 않는 파일입니다.";
        }
    }
?>

<!doctype html>
<html>
    <head>
        <title>example 1-2</title>
    </head>
    <body>
        <form action="youtube.php" method="get">
            <div style = "text-align: center;">
                <input type="text" placeholder="주소입력" id="address" name="address" >
                <select id="type" name="type">
                    <option value="video">비디오</option>
                    <option value="audio">오디오</option>
                </select>
                <button type="submit" class="btn">Confirm</button>

            </div>
        </form>
    </body>
</html>