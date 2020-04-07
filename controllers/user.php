

<?php
class UserController
{
    public static function actionholdersms()
    {
        $conn = Db::getConnection();
        $stid = oci_parse($conn,"select name, id from (select first_name||".
        "' '||name||' '||last_name as name, id from holders) where upper(name) like upper(:name)");
        $name="%".$_POST["name"]."%";
        oci_bind_by_name($stid, ":name", $name);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);
        echo $row["NAME"];
        return true;
    }
public static function actiontolatin()
    {
        $txt = $_POST["name"];
        $txt = mb_strtolower($txt);  
         $res = "";  
         for($i=0;$i<mb_strlen($txt);$i++)
         {
            $ch = mb_substr($txt,$i,1);
            switch ($ch) {
                
               case "а": $ch ="a"; break; case  "б": $ch ="b"; break; case  "в": $ch ="v"; break; 
               case "г": $ch ="g"; break; case  "д": $ch ="d"; break; case  "е": $ch ="e"; break; 
               case "ё": $ch ="yo"; break; case  "ж": $ch ="zh"; break; case  "з": $ch ="z"; break;
               case "и": $ch ="i"; break; case  "й": $ch ="y"; break; case  "к": $ch ="k"; break; 
               case "л": $ch ="l"; break; case  "м": $ch ="m"; break; case  "н": $ch ="n"; break; 
               case"о": $ch ="o"; break; case  "п": $ch ="p"; break; case  "р": $ch ="r"; break; 
               case "с": $ch ="s"; break; case  "т": $ch ="t"; break; case  "у": $ch ="u"; break; 
               case "ф": $ch ="f"; break; case  "х": $ch ="kh"; break; case  "ш": $ch ="sh"; break;     
               case "щ": $ch ="sh"; break; case  "ь": $ch =""; break; case  "э": $ch ="e"; break; 
               case "ю": $ch ="yu"; break; case  "я": $ch ="ya"; break; case  "ц": $ch ="c"; break; 
               case "ъ": $ch =""; break; case  "ч": $ch ="ch"; break; case  "ы": $ch ="i"; break; 
               case "ҷ": $ch ="j"; break; case  "ӯ": $ch ="u"; break; case  "ғ": $ch ="gh"; break;
               case "ҳ": $ch ="h"; break; case  "қ": $ch ="q"; break;
                default:
                    break;
            }
            $res .= $ch;
         }
         $res = mb_strtoupper($res);
         echo $res;
        
        return true;
    }
    public static function actiongivec()
    {
        $conn = Db::getConnection();
        $str = "select c.pay_sys||' '|| c.card_type||' '||substr(cc.card_num,1,4)||'********'||substr(cc.card_num,-4) as card,cc.id 
        from card_types c, cards cc, holders h, card_holder ch 
        where h.first_name||' '||h.name||' '||h.last_name=:nm  
        and h.id = ch.holder_id and ch.card_id = cc.id and c.id =cc.type_id";
        $stid = oci_parse($conn,$str);
        $nm = $_POST["name"];
        oci_bind_by_name($stid, ":nm",$nm);
        oci_execute($stid);
        $res = "";
        while($row = oci_fetch_assoc($stid))
        {
            $res.="<option value=\"".$row["ID"]."\">".$row["CARD"]."</option>";
        }
        echo $res;
    }
    public static function actionbank()
    {
        $conn = Db::getConnection();
        $stid = oci_parse($conn,"select id,emboss_snd from  holders where upper(first_name||".
        "' '||name||' '||last_name) like upper(:name)");
        $name="%".$_POST["int"]."%";
        oci_bind_by_name($stid, ":name", $name);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);
        $stid = oci_parse($conn,"insert into inter_bank values (:hid,:log,:hid)");
        oci_bind_by_name($stid, ":hid", $row["ID"]);
        oci_bind_by_name($stid, ":log", $row["EMBOSS_SND"]);
        oci_execute($stid);
        $_SESSION["message"]="Услуга интернет-банкинг успешно подключена.";
        $_SESSION["iholder"] = $_POST["int"];
        $_SESSION["ilogin"]  = $row["EMBOSS_SND"];
        $_SESSION["ipasswd"] = $row["ID"];
        header("Location: /user/operator");
        return true;

    }
    public static function actionsmsreg()
    {
        $str = "insert into card_serv values(:cid,1,sysdate)";
        $conn = Db::getConnection();
        $stid = oci_parse($conn,$str);
        oci_bind_by_name($stid,":cid",$_POST["sms_card"]);
        oci_execute($stid);
        $_SESSION["message"]="Услуга SMS-информирование успешно подключена!!!";
        header("Location: /user/operator");
    }
    public static function actionlivesr()
    {
        $conn = Db::getConnection();
        $str = "select distinct first_name||' '||name||' '||last_name as last_name   
        from holders 
        where lower(first_name||' '||name||' '||last_name) like lower(:nm)";
        $stid = oci_parse($conn,$str);
        $nm = "%".$_POST["name"]."%";
        oci_bind_by_name($stid, ":nm",$nm); 
        oci_execute($stid);
        $res = array();
        $i = 0;
        while($row = oci_fetch_assoc($stid))
        {
            $res[$i]=$row["LAST_NAME"];
            $i++;
        }
        echo implode(",",$res);
    }
    public static function actionregister()
    {
        
        $conn = Db::getConnection();
        
        $str =  "insert into holders(first_name,name,last_name,gender,email,phone,phone_pass,country,address,birth_date,passport_n,emboss_fst,emboss_snd".
        ") values (:bfirst_name,:bname,:blast_name,:bgender,:bemail,:bphone,:bphone_pass,:bcountry,:baddress,to_date(:bbirth_date,'yyyy-mm-dd'),:bpassport_n,:bemboss_fst,:bemboss_snd)".
        " returning id into :h_id";
        $stid = oci_parse($conn,$str);
        // binding, binding and binding !!!
        oci_bind_by_name($stid, ":bfirst_name", $_POST["firsname"]);
        oci_bind_by_name($stid, ":bname", $_POST["name"]);
        oci_bind_by_name($stid, ":blast_name", $_POST["lastname"]);
        oci_bind_by_name($stid, ":bgender", $_POST["gender"]);
        oci_bind_by_name($stid, ":bemail", $_POST["mail"]);
        oci_bind_by_name($stid, ":bphone", $_POST["tel"]);
        oci_bind_by_name($stid, ":bphone_pass", $_POST["telpar"]);
        oci_bind_by_name($stid, ":bcountry", $_POST["country"]);
        oci_bind_by_name($stid, ":baddress", $_POST["address"]);
        oci_bind_by_name($stid, ":bbirth_date", $_POST["dater"]);
        oci_bind_by_name($stid, ":bpassport_n", $_POST["passport"]);
        oci_bind_by_name($stid, ":bemboss_fst", $_POST["emfirst"]);
        oci_bind_by_name($stid, ":bemboss_snd", $_POST["emsecond"]);
        oci_bind_by_name($stid, ":h_id", $hid, -1, OCI_B_INT);
        oci_execute($stid);
        
        $q = "select id from card_types where lower(pay_sys) = lower(:pay) and lower(card_type) = lower(:type)";
        $stid = oci_parse($conn,$q);
        oci_bind_by_name($stid,":pay",$_POST["paysys"]);
        oci_bind_by_name($stid,":type",$_POST["type"]);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);
        $type_id = $row["ID"];
        $cvv = rand(100,999);
        
        $str2 = "insert into cards(type_id,issue_date,expire_date,state,cvv,balance,currency)".
              " values(:typeid,sysdate,sysdate + interval '3' year,1,:cvv,:balan,:curr)".
              " returning id into :c_id";
        $stid = oci_parse($conn,$str2);
        oci_bind_by_name($stid,":typeid",$type_id);
        oci_bind_by_name($stid,":cvv",$cvv);
        oci_bind_by_name($stid,":balan",$_POST["balance"]);
        oci_bind_by_name($stid,":curr",$_POST["curr"]);
        oci_bind_by_name($stid, ":c_id", $c_id, -1, OCI_B_INT);
        oci_execute($stid);
        echo $hid."<br>".$c_id;
        $str3 = "insert into card_holder values(:hid,:cid)";
        $stid = oci_parse($conn,$str3);
        oci_bind_by_name($stid,":hid",$hid);
        oci_bind_by_name($stid,":cid",$c_id);
        oci_execute($stid);
        $_SESSION["message"]="Карта успешно зарегистрирована!";
        header("Location: /user/operator");
        return true;
    }
    public static function actionedit()
    {
        $db = Db::getConnection();
        $res = $db->prepare("SELECT * FROM user WHERE id = :id");
        $res->bindParam(":id",$_SESSION["userid"],PDO::PARAM_STR);
        $res->execute();
        $user = $res->fetch();
        
        if(isset($_POST["name"]))
        {    
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $errors=false;
            if(!Validator::isNameValid($name))
                $errors[]= "Invalid name :(";
            
            if(!Validator::isPasswordValid($password))
               $errors[]= "Invalid password :(";
            
            if(!Validator::isEmailValid($email))
                $errors[]= "Invalid email :(";
            if(Validator::isEmailExists($email))
                $errors[]="Email $email already exists in our site!";
           
        }
        require_once("/views/edit.php");
        return true;
    }
    public static function actioncabinet()
    {
        /*if(isset($_SESSION["userid"]))
        {
            $db = Db::getConnection();
            $res = $db->prepare("SELECT * FROM user WHERE id = :id");
            $res->bindParam(":id",$_SESSION["userid"],PDO::PARAM_STR);
            $res->execute();
            $row = $res->fetch();
            require_once("/views/cabinet.php");
        }
        else header("Location: /user/login");*/
        $_SESSION["who"]=$_POST["who"];
        $_SESSION["login"]=$_POST["login"];
        $_SESSION["password"]=$_POST["password"];
        if($_POST["who"] == "holder") 
            header("Location: /user/holder");
        else if($_POST["who"] == "admin")
            header("Location: /user/admin");
        else
        {
            if($_SESSION["login"]=="operator" && $_SESSION["password"]=="1")
            header("Location: /user/operator");
            else 
            {
                $_SESSION["message"]="Неверные данные входа.";
                header("Location: /");
            }
        } 
            
            
        return true;
    }
    public static function actionholder()
    {
        $conn = Db::getConnection();
        $query = "select h.name, h.id from inter_bank ib, holders h 
        where  ib.login = :log and ib.passwd = :pass and ib.holder_id = h.id";
        $stid = oci_parse($conn,$query);
        oci_bind_by_name($stid,":log",$_SESSION["login"]);
        oci_bind_by_name($stid,":pass",$_SESSION["password"]);
        oci_execute($stid);
        if($row = oci_fetch_assoc($stid))
        {
            $holder_name = $row["NAME"];
            $_SESSION["hname"]=$row["NAME"];
            $str = "
                    select 
                        c.id,c.card_num,ct.pay_sys||' '||ct.card_type as type,c.issue_date, c.expire_date, st.state,c.balance,i.code_name  
                    from 
                        inter_bank ib, card_holder ch, cards c, card_types ct, states st, iso_curr i
                    where 
                        ib.login = :log and ib.passwd = :pass and ch.holder_id = ib.holder_id and ch.card_id = c.id
                        and c.currency = i.id and st.id = c.state and c.type_id = ct.id
                ";
            $stid = oci_parse($conn,$str);
            oci_bind_by_name($stid,":log",$_SESSION["login"]);
            oci_bind_by_name($stid,":pass",$_SESSION["password"]);
            oci_execute($stid);
            
            $i = 0;
            $mnu="cards";
            $cards = array();
            while($row = oci_fetch_assoc($stid))
            {
                $cards[$i]["type"]      = $row["TYPE"];
                $cards[$i]["number"]    = $row["CARD_NUM"];
                $cards[$i]["activated"] = $row["ISSUE_DATE"];
                $cards[$i]["exp_date"]  = $row["EXPIRE_DATE"];
                $cards[$i]["state"]     = $row["STATE"];
                $cards[$i]["id"]        = $row["ID"];
                $cards[$i]["balance"]   = $row["BALANCE"];
                $cards[$i]["curr"]      = $row["CODE_NAME"];
                $i++;
            } 
            require_once("/views/index-holder-page.php");
        }
        else 
        {
            $_SESSION["message"]="Неверные данные для входа.";
            header("Location: /");
        }
        return true;
    }
    public static function actionvipiska()
    {
        //$conn = Db::getConnection();
        
        //$_SESSION["res"]=$res;
        //header("Location: /user/derzh");
        //require_once("/views/index-holder-report.php");
        return true;
    }
    public static function actionderzh()
    {
        $conn = Db::getConnection();
        $query = "select h.name, h.id from inter_bank ib, holders h 
        where  ib.login = :log and ib.passwd = :pass and ib.holder_id = h.id";
        $stid = oci_parse($conn,$query);
        oci_bind_by_name($stid,":log",$_SESSION["login"]);
        oci_bind_by_name($stid,":pass",$_SESSION["password"]);
        oci_execute($stid);
        if($row = oci_fetch_assoc($stid))
        {
            $holder_name = $row["NAME"];

            $str = "
                    select 
                        c.id,c.card_num,ct.pay_sys||' '||ct.card_type as type,c.issue_date, c.expire_date, st.state,c.balance,i.code_name  
                    from 
                        inter_bank ib, card_holder ch, cards c, card_types ct, states st, iso_curr i
                    where 
                        ib.login = :log and ib.passwd = :pass and ch.holder_id = ib.holder_id and ch.card_id = c.id
                        and c.currency = i.id and st.id = c.state and c.type_id = ct.id 
                ";
            $stid = oci_parse($conn,$str);
            oci_bind_by_name($stid,":log",$_SESSION["login"]);
            oci_bind_by_name($stid,":pass",$_SESSION["password"]);
            oci_execute($stid);
            $res="";
            $i = 0;
            $mnu="cards";
            $cards = array();
            while($row = oci_fetch_assoc($stid))
            {
                $cards[$i]["type"]      = $row["TYPE"];
                $cards[$i]["number"]    = $row["CARD_NUM"];
                $cards[$i]["activated"] = $row["ISSUE_DATE"];
                $cards[$i]["exp_date"]  = $row["EXPIRE_DATE"];
                $cards[$i]["state"]     = $row["STATE"];
                $cards[$i]["id"]        = $row["ID"];
                $cards[$i]["balance"]   = $row["BALANCE"];
                $cards[$i]["curr"]      = $row["CODE_NAME"];
                $i++;
            }
            if(isset($_POST["bdate"]))
            {
                $stid = oci_parse($conn, "select to_char(t.tran_date,'dd.mm.yyyy hh24:mm:ss') as tran_date,(select tran_name from tran_types where id = t.tran_type) as tran,
                (select address from terminals where id = t.terminal_id) as terminal, t.ammount_tran_curr,
                (select code_name from iso_curr where id = t.tran_curr) as tran_curr, 
                case t.tran_type
                    when 3 then 0
                    else (select t.ammount_tran_curr *0.01*fee from tran_types where id = t.tran_type)
                    end case 
                    from  transactions t  where  t.card_id=:cid and t.tran_date between to_date(:bdate,'yyyy-mm-dd')- interval '1' day  
                            and to_date(:edate,'yyyy-mm-dd') + interval '1' day order by t.tran_date desc
                ");
                oci_bind_by_name($stid,":bdate",$_POST["bdate"]);
                oci_bind_by_name($stid,":edate",$_POST["edate"]);
                oci_bind_by_name($stid,":cid",$_POST["card_id"]);
                oci_execute($stid);
                $res ="<table><tr><th>Дата транзакции</th><th>Транзакция</th><th>Терминал</th><th>Сумма транзакции</th>
                <th>Валюта</th><th>Комиссия</th></tr>";
                while($row = oci_fetch_assoc($stid))
                {
                    $res .="<tr>";
                    $res .="<td>".$row["TRAN_DATE"]."</td>";
                    $res .="<td>".$row["TRAN"]."</td>";
                    $res .="<td>".$row["TERMINAL"]."</td>";
                    $res .="<td>".floatval($row["AMMOUNT_TRAN_CURR"])."</td>";
                    $res .="<td>".$row["TRAN_CURR"]."</td>";
                    $res .="<td>".floatval($row["CASE"])."</td>";
                    $res .="<tr>";
                }
                $res.="</table>";
            } 
            require_once("/views/index-holder-report.php");
        }
        else 
        {
            $_SESSION["message"]="Неверные данные для входа.";
            header("Location: /");
        }
        return true;   
    }
    public static function actionperevodi()
    {
        $conn = Db::getConnection();
        $query = "select h.name, h.id from inter_bank ib, holders h 
        where  ib.login = :log and ib.passwd = :pass and ib.holder_id = h.id";
        $stid = oci_parse($conn,$query);
        oci_bind_by_name($stid,":log",$_SESSION["login"]);
        oci_bind_by_name($stid,":pass",$_SESSION["password"]);
        oci_execute($stid);
        if($row = oci_fetch_assoc($stid))
        {
            $holder_name = $row["NAME"];

            $str = "
                    select 
                        c.id,c.card_num,ct.pay_sys||' '||ct.card_type as type,c.issue_date, c.expire_date, st.state,c.balance,i.code_name  
                    from 
                        inter_bank ib, card_holder ch, cards c, card_types ct, states st, iso_curr i
                    where 
                        ib.login = :log and ib.passwd = :pass and ch.holder_id = ib.holder_id and ch.card_id = c.id
                        and c.currency = i.id and st.id = c.state and c.type_id = ct.id
                ";
            $stid = oci_parse($conn,$str);
            oci_bind_by_name($stid,":log",$_SESSION["login"]);
            oci_bind_by_name($stid,":pass",$_SESSION["password"]);
            oci_execute($stid);
            $res="";
            $i = 0;
            $mnu="cards";
            $cards = array();
            while($row = oci_fetch_assoc($stid))
            {
                $cards[$i]["type"]      = $row["TYPE"];
                $cards[$i]["number"]    = $row["CARD_NUM"];
                $cards[$i]["activated"] = $row["ISSUE_DATE"];
                $cards[$i]["exp_date"]  = $row["EXPIRE_DATE"];
                $cards[$i]["state"]     = $row["STATE"];
                $cards[$i]["id"]        = $row["ID"];
                $cards[$i]["balance"]   = $row["BALANCE"];
                $cards[$i]["curr"]      = $row["CODE_NAME"];
                $i++;
            }
            if(isset($_POST["bdate"]))
            {
                $stid = oci_parse($conn, "select r.receiver,t.ammount_tran_curr, t.ammount_tran_curr * 0.04 as fee,
                case t.tran_curr 
                  when 1 then 'USD' when 2 then 'EUR' else 'TJS' end case,  t.ammount_tran_curr, 
                  to_char(t.tran_date,'dd.mm.yyyy hh24:mm:ss') as tran_date 
             from receivers r, transactions t, cards c where t.id=r.tran_id and c.id = :cid and c.id = t.card_id and  
             t.tran_date between to_date(:bdate,'yyyy-mm-dd')- interval '1' day and to_date(:edate,'yyyy-mm-dd')+ interval '1' day and
             t.tran_type = 1 order by t.tran_date desc");
                oci_bind_by_name($stid,":bdate",$_POST["bdate"]);
                oci_bind_by_name($stid,":edate",$_POST["edate"]);
                oci_bind_by_name($stid,":cid",$_POST["card_id"]);
                oci_execute($stid);
                $res ="<table><tr><th>Дата</th><th>Получатель</th><th>Сумма</th><th>Валюта транзакции</th><th>Комиссия</th></tr>";
                while($row = oci_fetch_assoc($stid))
                {
                    $res .="<tr>";
                    $res .="<td>".$row["TRAN_DATE"]."</td>";
                    $res .="<td>".$row["RECEIVER"]."</td>";
                    $res .="<td>".floatval($row["AMMOUNT_TRAN_CURR"])."</td>";
                    $res .="<td>".$row["CASE"]."</td>";
                    $res .="<td>".floatval($row["FEE"])."</td>";
                    
                    $res .="<tr>";
                }
                $res.="</table>";
            } 
            require_once("/views/perevodi.php");
        }
        else 
        {
            $_SESSION["message"]="Неверные данные для входа.";
            header("Location: /");
        }
        return true;   
    }
    public static function actioncalc()
    {
        $conn = Db::getConnection();
        $stid = oci_parse($conn,"select :summ * iso.sale + (:summ * iso.sale) * 0.04 as ammount from iso_curr iso where iso.id = :curr ");
        oci_bind_by_name($stid,":summ",$_POST["summ"]);
        oci_bind_by_name($stid,":curr",$_POST["curr"]);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);
        $ammount = $row["AMMOUNT"];

        $stid = oci_parse($conn,"select round(:amm/iso.sale,4) as am, iso.code_name from cards c, iso_curr iso
         where c.id = :id and iso.id = c.currency");
        oci_bind_by_name($stid,":id",$_POST["id"]);
        oci_bind_by_name($stid,":amm",$ammount);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid); 
        echo floatval($row["AM"]); echo " ".$row["CODE_NAME"];
    }
    public static function actionsnyatie()
    {

        $conn = Db::getConnection();
        $amm = floatval($_POST["sps"]);
        $stid = oci_parse($conn,"insert into transactions(card_id,tran_type,tran_curr,ammount_tran_curr,ammount_bal_curr,
        balance_after,tran_date,terminal_id) values (:cid,4,:tc,:amm,:sps,(select balance - :sps from cards where id =:cid),sysdate,
        5)");
        oci_bind_by_name($stid,":cid",$_POST["cash_cid"]);
        oci_bind_by_name($stid,":amm",$_POST["cash_amm"]);
        oci_bind_by_name($stid,":tc",$_POST["cash_curr"]);
        oci_bind_by_name($stid,":sps",$amm);
        oci_execute($stid);
        $stid = oci_parse($conn,"update cards set balance = balance - :sps where id = :cid");
        oci_bind_by_name($stid,":cid",$_POST["cash_cid"]);
        oci_bind_by_name($stid,":sps",$amm);
        oci_execute($stid);
        $_SESSION["message"]="Операция успешно выполнена! Заберите карту, денег и квитанцию.";
        header("Location: /user/holder");
        return true;
    }
    public static function actioncash()
    {
        $conn = Db::getConnection();
        $stid = oci_parse($conn,"select :summ * iso.sale + (:summ * iso.sale) * 0.01 as ammount from iso_curr iso where iso.id = :curr ");
        oci_bind_by_name($stid,":summ",$_POST["summ"]);
        oci_bind_by_name($stid,":curr",$_POST["curr"]);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);
        $ammount = $row["AMMOUNT"];

        $stid = oci_parse($conn,"select round(:amm/iso.sale,4) as am, iso.code_name from cards c, iso_curr iso
         where c.id = :id and iso.id = c.currency");
        oci_bind_by_name($stid,":id",$_POST["id"]);
        oci_bind_by_name($stid,":amm",$ammount);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid); 
        echo floatval($row["AM"]); echo " ".$row["CODE_NAME"];
    }
    public static function actiontransfer()
    {
        $conn = Db::getConnection();
        $stid = oci_parse($conn,"insert into transactions(card_id,tran_type,tran_curr,
        ammount_tran_curr,ammount_bal_curr,balance_after,tran_date,terminal_id) 
        values(:cid,1,:trncurr,:tr_amm,:ammbc,
        (select balance - :ammbc from cards where id=:cid),sysdate,9) returning id into :tr_id");
        oci_bind_by_name($stid,":cid",$_POST["card_id"]);
        oci_bind_by_name($stid,":trncurr",$_POST["curr"]);
        oci_bind_by_name($stid,":tr_amm",$_POST["summ"]);
        oci_bind_by_name($stid,":ammbc",$_POST["ammount"]);
        oci_bind_by_name($stid, ":tr_id", $tid, -1, OCI_B_INT);
        oci_execute($stid);
        
        $stid = oci_parse($conn,"insert into receivers values(:trid,:rec)");
        oci_bind_by_name($stid,":trid",$tid);
        oci_bind_by_name($stid,":rec",$_POST["receiver"]);
        oci_execute($stid);
        
        $stid = oci_parse($conn,"update cards set balance = balance - to_number(:amm) where id=:cid");
        oci_bind_by_name($stid,":amm",$_POST["ammount"]);
        oci_bind_by_name($stid,":cid",$_POST["card_id"]);
        oci_execute($stid);
        
        $stid = oci_parse($conn,"update cards set balance = balance + 
        exchange(to_number(:amm),to_number(:tc),(select currency from cards where card_num = :rec)) where card_num=:rec");
        oci_bind_by_name($stid,":amm",$_POST["summ"]);
        oci_bind_by_name($stid,":rec",$_POST["receiver"]);
        oci_bind_by_name($stid,":tc",$_POST["curr"]);
        oci_execute($stid);
        /*
        echo "ammount in card crr: ".$_POST["ammount"]."<br>";
        echo "card curr".$_POST["amm_curr"]."<br>";
        echo "card id ".$_POST["card_id"]."<br>";
        echo "summ in tran".$_POST["summ"]."<br>";
        echo "tran curr".$_POST["curr"]."<br>";
        echo "receiver".$_POST["receiver"]."<br>"*/;
        $_SESSION["message"]="Перевод успешно выполнен!";
        header("Location: /user/holder");
    }
    
    public static function actionadmin()
    {
        $reptype = "reptran";
        $res = "";
        require_once("/views/reports.php");
        return true;
    }
    public static function actionreptran()
    {
        $reptype = "reptran";
        $res = "";
        if(isset($_POST["post"]))
        {
            $conn = Db::getConnection();
            $str = "select 
            h.emboss_fst, h.emboss_snd, hidecard(c.card_num) as card_num, tt.tran_name, t.ammount_tran_curr,iso.code_name, to_char(t.tran_date,'dd.mm.yyy HH24:mm:ss') as \"TIME\"
        from 
            holders h, cards c, card_holder ch, transactions t, tran_types tt, iso_curr iso
        where 
            h.id = ch.holder_id and ch.card_id = c.id and c.id = t.card_id and t.tran_type = tt.id and 
            t.tran_curr = iso.id and t.tran_date > to_date(:bdate,'yyyy-mm-dd')- interval '1' day  
            and t.tran_date < to_date(:edate,'yyyy-mm-dd') + interval '1' day
        order by t.tran_date desc";
           $stid = oci_parse($conn,$str);
           oci_bind_by_name($stid,":bdate",$_POST["bdate"]);
           oci_bind_by_name($stid,":edate",$_POST["edate"]);
           oci_execute($stid);
           $res .= "<table border=\"0\"  class=\"reptable table table-bordered table-striped table-hover\" class=\"reptable\">";
           $res .= "<tr style=\" font-weight: bold; \"><td>Эмб. фамилия</td> <td>Эмб. имя</td> <td>Номер карты</td> <td>Транзакция</td> 
                    <td>Сумма</td> <td>Валюта</td> <td>Дата и время</td> </tr>";
           while($row = oci_fetch_assoc($stid))
           {
               $res .="<tr>";
               $res .="<td>".$row["EMBOSS_FST"]."</td>";
               $res .="<td>".$row["EMBOSS_SND"]."</td>";
               $res .="<td>".$row["CARD_NUM"]."</td>";
               $res .="<td class=\"text-center text-nowrap\">".$row["TRAN_NAME"]."</td>";
               $res .="<td>".floatval($row["AMMOUNT_TRAN_CURR"])."</td>";
               $res .="<td>".$row["CODE_NAME"]."</td>";
               $res .="<td class=\"text-center text-nowrap\">".$row["TIME"]."</td>";
               $res .="</tr>";
           }
           
           $res .= "</table>";
        }
        require_once("/views/reports.php");
        return true;
    }

    public static function actionmillion()     
    {         
        $reptype = "million";
        $res ="";   
    if(isset($_POST["post"]))
    {
           $conn = Db::getConnection();
            $str = "select first_name, name ,card_type, rpad(balance,10,' ')||
            (select code_name from iso_curr where id = currency) as balance from 
            (
                select 
                    first_name, name,currency,
                    (select pay_sys||' '||card_type from card_types where id = c.type_id) as card_type,
                    balance
                from 
                    holders h, cards c, card_holder ch 
                where 
                    h.id = ch.holder_id and ch.card_id = c.id and balance is not null
                order by exchange(balance,c.currency,8) desc
            )
        where rownum<=10";
        $stid = oci_parse($conn,$str);
        oci_execute($stid);
        $res .= "<table border=\"0\"  class=\"reptable table table-bordered table-striped table-hover\" class=\"reptable\">";
        $res .= "<tr style=\" font-weight: bold; \"><td>Фамилия</td><td>Имя</td><td>Тип карты</td><td>Баланс</td></tr>";
        while ($row = oci_fetch_assoc($stid)) 
        {
            $res .= "<tr>";
            $res .= "<td>".$row["FIRST_NAME"]."</td>";
            $res .= "<td>".$row["NAME"]."</td>";
            $res .= "<td>".$row["CARD_TYPE"]."</td>";
            $res .= "<td>".$row["BALANCE"]."</td>";
            $res .= "</tr>";
            
        }
        $res .="</table>";
    }      
        require_once("/views/reports.php");         
        return true;     
    }
    public static function actionfees()     
    {         
        $reptype = "fees";         
        $res ="";   
        if(isset($_POST["post"]))
        {
               $conn = Db::getConnection();
                $str = "select 
                t.tran_name,
                res.tran_type, 
                res.cnt, 
                (
                   select 
                        sum(trn.ammount_tran_curr) 
                   from 
                        transactions trn
                   where trn.tran_type = t.id
                )*0.01*t.fee as summa 
            from 
                (
                    select tran_type, 
                        count(tran_type) as cnt 
                    from 
                        transactions, tran_types 
                    where 
                        tran_type = tran_types.id 
                    group by tran_type
                ) res, 
                tran_types t
            where 
                t.id = res.tran_type";
            $stid = oci_parse($conn,$str);
            oci_execute($stid);
            $res .= "<table border=\"0\"  class=\"reptable table table-bordered table-striped table-hover\" class=\"reptable\">";
            $res .= "<tr style=\" font-weight: bold; \"><td>Транзакция</td><td>Количество</td><td>Доходы</td></tr>";
            while ($row = oci_fetch_assoc($stid)) 
            {
                $res .= "<tr>";
                $res .= "<td>".$row["TRAN_NAME"]."</td>";
                $res .= "<td>".$row["CNT"]."</td>";
                $res .= "<td>".$row["SUMMA"]."</td>";
                $res .= "</tr>";
                
            }
            $res .="</table>";
        }
        require_once("/views/reports.php");         
        return true;     
    }
    public static function actionrepcards()     
    {         
        $reptype = "repcards";
        $res = "";         
        if(isset($_POST["post"]))
        {
               $conn = Db::getConnection();
                $str = " select * from (
                    select card_type ,to_char(count(*)) as cnt 
                    from (select ct.pay_sys||' '||ct.card_type as card_type from card_types ct, cards c where c.type_id = ct.id) 
                    group by card_type order by card_type)
                    ";
            $stid = oci_parse($conn,$str);
            oci_execute($stid);
            $res .= "<table border=\"0\"  class=\"reptable table table-bordered table-striped table-hover\" class=\"reptable\">";
            $res .= "<tr style=\" font-weight: bold; \"><td>Тип карты</td><td>Количество</td></tr>";
            while ($row = oci_fetch_assoc($stid)) 
            {
                $res .= "<tr>";
                $res .= "<td>".$row["CARD_TYPE"]."</td>";
                $res .= "<td>".$row["CNT"]."</td>";
                $res .= "</tr>";
                
            }
            $res .="</table>";
        }
        require_once("/views/reports.php");         
        return true;     
    }
    public static function actiontsp()     
    {         
        $reptype = "tsp";         
        $res = "";         
        if(isset($_POST["post"]))
        {
               $conn = Db::getConnection();
                $str = " select * from(     
                    select t.id, t.type, t.address, 
                        case  
                            when not exists(select * from transactions where terminal_id = t.id) 
                            then 'Нет транзакции с момента установки' 
                            when  exists(select * from transactions where terminal_id = t.id) and
                                  not  exists(select * from transactions where terminal_id = t.id and tran_date > sysdate - interval '2' month)
                                  then 'Дата последней транзакции ' || (select max(tran_date) from transactions where terminal_id = t.id) 
                            else 
                               'Active'
                        end case  
                    from terminals t)
                    where case <>'Active' order by case
                    ";
            $stid = oci_parse($conn,$str);
            oci_execute($stid);
            $res .= "<table border=\"0\"  class=\"reptable table table-bordered table-striped table-hover\" class=\"reptable\">";
            $res .= "<tr style=\" font-weight: bold; \"><td>Номер терминала</td><td>Тип терминала</td><td>Адрес</td><td>Причина</td></tr>";
            while ($row = oci_fetch_assoc($stid)) 
            {
                $res .= "<tr>";
                $res .= "<td>".$row["ID"]."</td>";
                $res .= "<td>".$row["TYPE"]."</td>";
                $res .= "<td>".$row["ADDRESS"]."</td>";
                $res .= "<td>".$row["CASE"]."</td>";
                $res .= "</tr>";
                
            }
            $res .="</table>";
        }
        require_once("/views/reports.php");         
        return true;     
    }
    public static function actiontransfers()     
    {         
        $reptype = "transfers";         
        $res = "";         
        if(isset($_POST["post"]))
        {
               $conn = Db::getConnection();
                $str = "select t.id as tran_no, hidecard(c.card_num) as sender,hidecard(r.receiver) as receiver, 
                case t.tran_curr 
                  when 1 then 'USD' when 2 then 'EUR' else 'TJS' end case,  t.ammount_tran_curr, 
                  to_char(t.tran_date,'dd.mm.yyyy hh24:mm:ss') as tran_date 
             from receivers r, transactions t, cards c where t.id=r.tran_id and c.id = t.card_id and  
             t.tran_date between to_date(:bdate,'yyyy-mm-dd')- interval '1' day and to_date(:edate,'yyyy-mm-dd')+ interval '1' day and
             t.tran_type = 1 order by tran_date desc
                    ";
            $stid = oci_parse($conn,$str);
            oci_bind_by_name($stid,":bdate",$_POST["bdate"]);
            oci_bind_by_name($stid,":edate",$_POST["edate"]);
            
            oci_execute($stid);
            $res .= "<table border=\"0\"  class=\"reptable table table-bordered table-striped table-hover\" class=\"reptable\">";
            $res .= "<tr style=\" font-weight: bold; \"><td>Номер транзакции</td><td>Отправитель</td><td>Получатель</td><td>Сумма</td><td>Валюта</td><td>Дата</td></tr>";
            while ($row = oci_fetch_assoc($stid)) 
            {
                $res .= "<tr>";
                $res .= "<td>".$row["TRAN_NO"]."</td>";
                $res .= "<td>".$row["SENDER"]."</td>";
                $res .= "<td>".$row["RECEIVER"]."</td>";
                $res .= "<td>".floatval($row["AMMOUNT_TRAN_CURR"])."</td>";
                $res .= "<td>".$row["CASE"]."</td>";
                $res .= "<td class=\"text-center text-nowrap\">".$row["TRAN_DATE"]."</td>";
                $res .= "</tr>";                
            }
            $res .="</table>";
        }
        require_once("/views/reports.php");         
        return true;     
    }
    
    public static function actionoldcards()     
    {         
        $reptype = "oldcards";         
        $res = "";         
        if(isset($_POST["post"]))
        {
               $conn = Db::getConnection();
                $str = "select 
                h.first_name, h.name, h.last_name,h.phone,h.phone_pass,
                (select pay_sys||' '||card_type from card_types where id = c.type_id) as card_type, 
                substr(c.card_num,1,4)||'********'||substr(c.card_num,-4) as card_num,
                c.expire_date
            from 
                holders h, card_holder ch, cards c
            where 
                h.id = ch.holder_id and ch.card_id = c.id and c.expire_date <= sysdate
                    ";
            $stid = oci_parse($conn,$str);
            oci_execute($stid);
            $res .= "<table border=\"0\"  class=\"reptable table table-bordered table-striped table-hover\" class=\"reptable table table-bordered table-striped table-hover\">";
            $res .= "<tr style=\" font-weight: bold; \"><td class=\"text-center\">Фамилия</td><td>Имя</td><td>Отчество</td><td>Телефон</td><td class=\"text-nowrap\">Тел. пароль</td><td class=\"text-nowrap\">Тип карты
            </td><td>Номер карты</td><td class=\"text-nowrap\">Истёк срок</td></tr>";
            while ($row = oci_fetch_assoc($stid)) 
            {
                $res .= "<tr>";
                $res .= "<td class=\"text-center\">".$row["FIRST_NAME"]."</td>";
                $res .= "<td class=\"text-center\">".$row["NAME"]."</td>";
                $res .= "<td class=\"text-center\">".$row["LAST_NAME"]."</td>";
                $res .= "<td class=\"text-center\">".$row["PHONE"]."</td>";
                $res .= "<td class=\"text-center\">".$row["PHONE_PASS"]."</td>";
                $res .= "<td class=\"text-center text-nowrap\">".$row["CARD_TYPE"]."</td>";
                $res .= "<td class=\"text-center\">".$row["CARD_NUM"]."</td>";
                $res .= "<td class=\"text-center text-nowrap\">".$row["EXPIRE_DATE"]."</td>";
                $res .= "</tr>";                
            }
            $res .="</table>";
        }
        require_once("/views/reports.php");         
        return true;     
    } 
    public static function actionhot()     
    {         
        $reptype = "hot";
        $res = "";         
        if(isset($_POST["post"]))
        {
               $conn = Db::getConnection();
                $str = "select (select type from terminals where id = terminal_id) as type,
                (select address from terminals where id = terminal_id) as terminal,cnt from (
                                    select terminal_id, count(*) cnt 
                                    from transactions group by 
                                    terminal_id order by cnt desc)
                            where rownum <= 10";
            $stid = oci_parse($conn,$str);
            oci_execute($stid);
            $res .= "<table border=\"0\"  class=\"reptable table table-bordered table-striped table-hover\" class=\"reptable table table-bordered table-striped table-hover\">";
            $res .= "<tr style=\" font-weight: bold; \"><td class=\"text-center\">Тип терминала</td><td class=\"text-center\">Терминал</td><td>Количество операций</td></tr>";
            while ($row = oci_fetch_assoc($stid)) 
            {
                $res .= "<tr>";
                $res .= "<td class=\"text-center\">".$row["TYPE"]."</td>";
                $res .= "<td class=\"text-center\">".$row["TERMINAL"]."</td>";
                $res .= "<td class=\"text-center\">".$row["CNT"]."</td>";
                $res .= "</tr>";                
            }
            $res .="</table>";
        }         
        require_once("/views/reports.php");         
        return true;     
    }
    public static function actionatms()     
    {         
        $reptype = "atms";         
        $res = "";         
        if(isset($_POST["post"]))
        {
               $conn = Db::getConnection();
                $str = "select address, balance from terminals where balance <100 and type = 'ATM'";
            $stid = oci_parse($conn,$str);
            oci_execute($stid);
            $res .= "<table border=\"0\"  class=\"reptable table table-bordered table-striped table-hover\" class=\"reptable table table-bordered table-striped table-hover\">";
            $res .= "<tr style=\" font-weight: bold; \"><td class=\"text-center\">Терминал</td><td>Баланс</td></tr>";
            while ($row = oci_fetch_assoc($stid)) 
            {
                $res .= "<tr>";
                $res .= "<td class=\"text-center\">".$row["ADDRESS"]."</td>";
                $res .= "<td class=\"text-center\">".$row["BALANCE"]."</td>";
                $res .= "</tr>";                
            }
            $res .="</table>";
        }
        require_once("/views/reports.php");         
        return true;     
    }
    

    public static function actionoperator()
    {
        
        require_once("/views/index-operator-page.php");
        return true;
    }
    public static function actionlogin()
    {
        
        
        require_once("/views/index-login.php");
        return true;
    }
    public static function actionlogout()
    {
        unset($_SESSION["userid"]);
        header("Location: /user/login");
        return true;
    }
}