<?php

namespace Members_space\Controller;
use Members_space\Entity\Members;
use Members_space\Repository\MemberRepository;

if (isset($_POST['inscription']))
{
    if (isset($_POST['pseudo']) && isset($_POST['password']) 
    && isset($_POST['confirmedPassword']) && isset($_POST['email']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);
        $confirmedPassword = htmlspecialchars($_POST['confirmedPassword']);
        $email = htmlspecialchars($_POST['email']);

        $memberRepository = new MemberRepository();
        $member1 = $memberRepository->findBy('pseudo', $pseudo);
        $member2 = $memberRepository->findBy('email', $email);
        if (sizeof($member1) == 0 && sizeof($member2) == 0)
        {
            if ($password == $confirmedPassword)
            {
                $hashPassword = \password_hash($password, PASSWORD_DEFAULT);
                $member = new Members($pseudo, $hashPassword, $email);

                $memberRepository->insert($member);

                header('Location: ../view/connection.html');
            }
        }
    }
}

else if (isset($_POST['connection']))
{
    if (isset($_POST['pseudoOrEmail']) && isset($_POST['password']))
    {
        $pseudoOrEmail = htmlspecialchars($_POST['pseudoOrEmail']);
        $password = htmlspecialchars($_POST['password']);
    }
}
?>