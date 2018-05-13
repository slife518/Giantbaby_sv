<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <form action="./process.php" method="POST">
            <p>email : <input type="text" name="email"></p>
            <p>passwd : <input type="text" name="pw"></p>
            <p>todate : <input type="text" name="date"></p>
            <p>hour : <input type="text" name="hour"></p>
            <p>min : <input type="text" name="min"></p>
            <p>tcenter : <input type="text" name="center"></p>
            <p>유형 : <input type="hidden" name="mode" value=""></p>
            <p>본문 : <textarea name="description" id="" cols="30" rows="10"></textarea></p>
            <p><input type="submit" name="전송"/></p>
        </form>
        <!-- <form action="./process.php?mode=delete" method="POST">
            <p><input type="submit" name="삭제"/></p>
        </form> -->
    </body>
</html>
