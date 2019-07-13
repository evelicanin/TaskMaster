function bCrypt($pass,$cost)
{
      $chars='./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

      // Build the beginning of the salt
      $salt=sprintf('$2a$%02d$',$cost);
      // Seed the random generator

      mt_srand();

      // Generate a random salt
      for($i=0;$i<22;$i++) $salt.=$chars[mt_srand(0,63)];

     // return the hash
    return crypt($pass,$salt);
}

// Usage
// Set the password in a variable
$pass = 'Password';
$hash = bCrypt($pass,12);

// We've now got the hash and can store it in a db, or in a file.

// To check the password
if ($hash == crypt($pass,$hash)){
echo "Logged in";
}else{
echo "access denied"
}