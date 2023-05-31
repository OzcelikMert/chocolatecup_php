<?php
class Encrypter{
    function __construct($type){
        $this->Type = $type;
    }

    /* Variables */
    private $Type = "";
    private $EncryptData = array(
        "matrix-1" => "a1,b5,c8,d9,58,57,gh,cu,df,ki,lp,lc,nj,k8,r3,f0,09,s8,f9,a2,v1,eq,az,zq,vf,f9,g5,h2,cd,d8,lo,li,ul,9i,2p,c0,85,89,98,26,c5,j0,3j,f3,jq,qj,7q,j8,u3,3u,4a,12,19,96,36,79,bn,ci,uc,00,34,sl,er,tr,pl,mn,s1,e6,u1,p3,g5,kk,qo"
    );
    private $CharacterData = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,r,s,t,u,v,y,z,w,x,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,R,S,T,U,V,Y,Z,W,X,1,2,3,4,5,6,7,8,9,0,@,/,!,',+,-,*,=,_,%,#,q,Q";
    /* end Variables */
    
    // Encrypt
    public function MatrixEncrypt($variable){
        $Explode_EncryptData = explode(",", $this->EncryptData[$this->Type]);
        $Explode_CharacterData = explode(",", $this->CharacterData);
        
        $PlusValue = strlen($Explode_CharacterData[0]);

        $EncrpytVariable = "";
        for ($i=0; $i < strlen($variable); $i+=$PlusValue) {
            $index = array_search(substr($variable, $i, $PlusValue), $Explode_CharacterData);
            $EncrpytVariable .= $Explode_EncryptData[$index];
        }

        return $EncrpytVariable;
    }
    // Decrypt
    public function MatrixDecrypt($variable){
        $Explode_EncryptData = explode(",", $this->EncryptData[$this->Type]);
        $Explode_CharacterData = explode(",", $this->CharacterData);
        
        $PlusValue = strlen($Explode_EncryptData[0]);

        $DecrpytVariable = "";
        for ($i=0; $i < strlen($variable); $i+=$PlusValue) {
            $index = array_search(substr($variable, $i, $PlusValue), $Explode_EncryptData);
            $DecrpytVariable .= $Explode_CharacterData[$index];
        }

        return $DecrpytVariable;
    }
}
?>