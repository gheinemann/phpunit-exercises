<?php
namespace tools {
    class Mapper {
        static private $profession_table = array(
            "10" => "1",
            "21" => "2",
            "40" => "5",
            "50" => "4"
        );
        static private $em_table = array(
            "H" => "4",
            "L" => "1",
            "S" => "2",
            "M" => "3",
            "R" => "6"
        );
        static private $gender_table = array(
            "M" => "4",
            "DR" => "1",
            "MME" => "2",
            "MLLE" => "3"
        );
        static private $specialty_table = array(
            "81" => "1",
            "DSM200" => "3",
            "CAPA01" => "4",
            "CAPA02" => "140",
            "C33" => "6",
            "DSM201" => "6",
            "SM01" => "9",
            "C01" => "9",
            "DSM202" => "143",
            "SM02" => "7",
            "C34" => "100",
            "CAPA04" => "100",
            "DSM203" => "143",
            "DSM204" => "14",
            "SM03" => "14",
            "DSM205" => "14",
            "C35" => "90",
            "C07" => "10",
            "SM04" => "10",
            "DSM207" => "24",
            "C83" => "24",
            "SM05" => "22",
            "SM09" => "23",
            "C10" => "24",
            "SM07" => "24",
            "SCD02" => "24",
            "C12" => "27",
            "SM08" => "27",
            "C68" => "23",
            "DSM208" => "26",
            "SM10" => "26",
            "C11" => "31",
            "SM11" => "29",
            "SM12" => "22",
            "SM13" => "29",
            "SM14" => "22",
            "DSM210" => "143",
            "C15" => "34",
            "SM15" => "34",
            "DSM211" => "34",
            "C36" => "32",
            "C37" => "48",
            "SM16" => "48",
            "C75" => "48",
            "CAPA05" => "143",
            "FQ03" => "143",
            "FQ02" => "143",
            "FQ01" => "143",
            "FQ05" => "143",
            "SM24" => "139",
            "C72" => "143",
            "SM18" => "56",
            "CAPA06" => "56",
            "SM52" => "58",
            "SM51" => "58",
            "CEX24" => "58",
            "CEX22" => "58",
            "C23" => "58",
            "SM20" => "58",
            "SM21" => "59",
            "SM22" => "59",
            "SM23" => "59",
            "DSM214" => "59",
            "DSM215" => "59",
            "DSM216" => "59",
            "80" => "74",
            "CAPA07" => "75",
            "DSM217" => "66",
            "C29" => "139",
            "C38" => "59",
            "CAPA08" => "74",
            "C05" => "81",
            "SCD03" => "127",
            "DSM220" => "140",
            "CAPA09" => "140",
            "DSM235" => "123",
            "DSM218" => "143",
            "CAPA11" => "82",
            "DSM219" => "81",
            "SM25" => "82",
            "CAPA10" => "81",
            "C31" => "66",
            "SM54" => "74",
            "SM27" => "76",
            "C40" => "40",
            "DSM221" => "40",
            "SM28" => "78",
            "CAPA12" => "143",
            "SM29" => "113",
            "C71" => "75",
            "CAPA13" => "66",
            "DSM223" => "100",
            "DSM224" => "96",
            "SM30" => "85",
            "SM31" => "141",
            "SM33" => "84",
            "SM32" => "84",
            "DSM225" => "84",
            "DSM226" => "143",
            "SM34" => "92",
            "CEX26" => "58",
            "SM35" => "90",
            "SM36" => "90",
            "SM37" => "90",
            "SM38" => "91",
            "SCD01" => "127",
            "C76" => "127",
            "SM39" => "92",
            "DSM228" => "66",
            "SM40" => "96",
            "SCH51" => "143",
            "DSM230" => "93",
            "C52" => "92",
            "SM41" => "105",
            "CAPA14" => "40",
            "SM42" => "104",
            "DSM231" => "104",
            "C58" => "104",
            "SM43" => "104",
            "PAC00" => "143",
            "SM26" => "74",
            "SM44" => "46",
            "SM45" => "78",
            "DSM232" => "143",
            "C39" => "112",
            "SM46" => "112",
            "SM47" => "143",
            "SM48" => "114",
            "SM49" => "118",
            "SM53" => "74",
            "SM50" => "127",
            "CAPA15" => "143",
            "DSM234" => "133",
            "CAPA16" => "133",
            "CEX64" => "136"
        );

        static private $convmap = array(0x80, 0xff, 0, 0xff);

        public static function mapTitle($pTitle) {
            if (array_key_exists($pTitle, self::$gender_table)) {
                $pTitle = self::$gender_table[$pTitle];
            }
            return $pTitle;
        }

        public static function mapData($pRppsData) {
            if (!is_array($pRppsData) || empty($pRppsData)) {
                return null;
            }

            $datas = array();
            foreach ($pRppsData as $field_id => $field_value) {
                switch($field_id) {
                    case 'title':
                        $datas['gender_id']  = "";
                        $field_value = strtoupper($field_value);

                        if (isset(self::$gender_table[$field_value])) {
                            $datas['gender_id'] = self::$gender_table[$field_value];
                        }
                        break;
                    case 'name':
                    case 'town':
                        $decoded = mb_decode_numericentity($field_value, self::$convmap, 'UTF-8');
                        $datas[$field_id] = strtoupper($decoded);
                        break;
                    case 'firstname':
                        $decoded = mb_decode_numericentity($field_value, self::$convmap, 'UTF-8');
                        $delimiters = array('-', '\'');

                        $decoded = ucwords(strtolower($decoded));
                        foreach ($delimiters as $delimiter) {
                            if (strpos($decoded, $delimiter)!==false) {
                                $decoded =implode($delimiter, array_map('ucfirst', explode($delimiter, $decoded)));
                            }
                        }
                        $datas[$field_id] = $decoded;
                        break;
                    case 'postalCode':
                        $datas[$field_id] = $field_value;
                        break;
                    case 'exerciseMode':
                        $datas[$field_id] = self::$em_table[$field_value];
                        $datas['exerciseModePharma_id'] = $datas[$field_id];
                        break;
                    case 'specialty_id':
                        $datas['specialite_id'] = '';
                        if (isset(self::$specialty_table[$field_value])) {
                            $datas['specialite_id'] = self::$specialty_table[$field_value];
                        }
                        break;
                    case 'profession_id':
                        if (isset(self::$profession_table[$field_value])) {
                            $datas[$field_id] = self::$profession_table[$field_value];
                        }
                        break;
                }
            }

            // if profession is PHARMACIEN, determine exercise mode
            if (isset($datas['profession_id']) && $datas['profession_id'] == 2) {
                switch($pRppsData['exerciseMode']) {
                    case "S":
                        $datas['exerciseModePharma_id'] = 2;
                        break;
                    case "H":
                        $datas['exerciseModePharma_id'] = 4;
                        break;
                    case "L":
                        $datas['exerciseModePharma_id'] = 8;
                        break;
                    case "R":
                        $datas['exerciseModePharma_id'] = 6;
                        break;
                    default:
                        $datas['exerciseModePharma_id'] = 10;
                        break;
                }
            }

            return $datas;
        }

        public static function mapDataToDB($pRppsData){
            $datas = self::mapData($pRppsData);
            $mapped_datas = array();

            foreach ($datas as $field_id => $field_value) {
                switch($field_id) {
                    case 'buisness':
                        $mapped_datas['places'] = $field_value;
                        break;
                    case 'gender_id':
                        $mapped_datas['id_title'] = $field_value;
                        break;
                    case 'name':
                        $mapped_datas['name_user'] = $field_value;
                        break;
                    case 'firstname':
                        $mapped_datas['firstname_user'] = $field_value;
                        break;
                    case 'town':
                        $mapped_datas['city_user'] = $field_value;
                        break;
                    case 'postalCode':
                        $mapped_datas['postal_code_user'] = $field_value;
                        break;
                    case 'elu':
                        $mapped_datas['elu'] = $field_value;
                        break;
                    case 'exerciseMode':
                        $mapped_datas['id_em'] = $field_value;
                        break;
                    case 'exerciseModePharma_id':
                        $mapped_datas['id_em'] = $field_value;
                        $mapped_datas['exerciseModePharma_id'] = $field_value;
                        break;
                    case 'specialite_id':
                        $mapped_datas['id_specialty'] = $field_value;
                        break;
                    case 'profession_id':
                        $mapped_datas['id_profession'] = $field_value;
                        break;
                    default:
                        $mapped_datas[$field_id] = $field_value;
                        break;
                }
            }

            return $mapped_datas;
        }
	}
}
