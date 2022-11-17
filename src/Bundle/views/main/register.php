<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                fullname: {
                    required: true
                },
                username: {
                    email: true,
                    required: true
                },
                contact: {
                    required: true
                },
                grupo: {
                    required: true
                },
                clave: {
                    required: true,
                    minlength: 4
                },
                clave2: {
                    required: true,
                    minlength: 4,
                    equalTo: "#clave"
                }
            },
            errorElement: "div"
        });


        $("#ingreso").click(function() {
            var url = '<?= $urls['login'] ?>';
            $(location).attr('href', url);
        });

        $("#submit").click(function() {
            //validando
            if (!$("#form1").valid()) {
                return false;
            }

            var formData = $("#form1").serialize();
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type: "POST",
                url: "<?= $urls['save'] ?>",
                cache: false,
                data: formData,
                success: function(data, status) {
                    data = $.trim(data);
                    if (data == '1') {
                        data = 'Registro exitoso';
                        waitAndRedirect('<?= $urls['login'] ?>', 2100);
                    } else {
                        $('#submit').removeAttr('disabled');
                    }
                    $("#mensaje").html(data);
                }
            });
            return false;
        });

    });

    const waitAndRedirect = (url, time) => {
        setTimeout(() => {
            window.location.href = url;
        }, time);
    }
</script>


<article>
    <div>
        <h1 style="text-align: left"><img src="../images/wc2022.png"></h1>
        <form name="form1" id="form1">
            <fieldset>
                <label for="fullname">Nombre completo:</label>
                <input id="fullname" name="fullname" value="">
            </fieldset>
            <fieldset>
                <label for="username">Correo:</label>
                <input id="username" name="username" value="">
            </fieldset>

            <fieldset>
                <label for="grupo">Hotel</label>
                <select name="grupo" id="grupo" required="">
                <option value="">Seleccione</option>
                    <?php while ($group = $groups->getRowFields()) { ?>
                        <option value="<?= $group->id ?>"><?= $group->nombre ?></option>
                    <?php  } ?>
                </select>
            </fieldset>

            
            <fieldset>
                <label for="habitacion">Habitacion:</label>
                <INPUT id="habitacion" name="habitacion" value="">
                    
                </select>
            </fieldset>

            <fieldset>
                <label for="clave">Contraseña:</label>
                <input id="clave" name="clave" type="password" value="">
            </fieldset>

            <fieldset>
                <label for="clave2">Repita contraseña:</label>
                <input id="clave2" name="clave2" type="password" value="">
            </fieldset>

          <fieldset>
                <div class="g-recaptcha" data-sitekey="<?=$siteKey?>"></div>
          </fieldset>
               



            <div id="mensaje">&nbsp;</div>
        </form>
    </div>
    <footer>
        <div>
            <input id="submit" class="contrast" type="submit" value="Guardar">
        </div>
    </footer>
</article>