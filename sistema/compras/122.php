<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <base href="<%=basePath%>">

    <title>My JSP 'index.jsp' starting page</title>
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
    <meta http-equiv="description" content="This is my page">
</head>

<body>
    <table id="test">
        <tbody>
            <tr>
                <td>Test Row Prepend</td>
            </tr>
            <tr>
                <td>Foo</td>
            </tr>
            <tr>
                <td>Test Row Append</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>footer information</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>

<script>
    $("#test>tbody").append("<tr><td>Test Row Append</td></tr>");
    //adding row to end and start
    $("#test>tbody").prepend("<tr><td>Test Row Prepend</td></tr>");
</script>