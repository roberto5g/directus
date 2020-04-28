/*****
 * CONFIGURATION
 */

//Main navigation
$.navigation = $('nav > ul.nav');

$.panelIconOpened = 'icon-arrow-up';
$.panelIconClosed = 'icon-arrow-down';

//Default colours
$.brandPrimary = '#20a8d8';
$.brandSuccess = '#4dbd74';
$.brandInfo = '#63c2de';
$.brandWarning = '#f8cb00';
$.brandDanger = '#f86c6b';

$.grayDark = '#2a2c36';
$.gray = '#55595c';
$.grayLight = '#818a91';
$.grayLighter = '#d1d4d7';
$.grayLightest = '#f8f9fa';

'use strict';

/****
 * MAIN NAVIGATION
 */

$(document).ready(function ($) {

    // Add class .active to current link
    $.navigation.find('a').each(function () {

        var cUrl = String(window.location).split('?')[0];

        if (cUrl.substr(cUrl.length - 1) == '#') {
            cUrl = cUrl.slice(0, -1);
        }

        if ($($(this))[0].href == cUrl) {
            $(this).addClass('active');

            $(this).parents('ul').add(this).each(function () {
                $(this).parent().addClass('open');
            });
        }
    });

    // Dropdown Menu
    $.navigation.on('click', 'a', function (e) {

        if ($.ajaxLoad) {
            e.preventDefault();
        }

        if ($(this).hasClass('nav-dropdown-toggle')) {
            $(this).parent().toggleClass('open');
            console.log('dropdown-toggledropdown-toggledropdown-toggle')
            resizeBroadcast();
        }

    });

    function resizeBroadcast() {

        var timesRun = 0;
        var interval = setInterval(function () {
            timesRun += 1;
            if (timesRun === 5) {
                clearInterval(interval);
            }
            window.dispatchEvent(new Event('resize'));
        }, 62.5);
    }

    /* ---------- Main Menu Open/Close, Min/Full ---------- */
    $('.sidebar-toggler').click(function () {
        $('body').toggleClass('sidebar-hidden');
        resizeBroadcast();
    });

    $('.sidebar-minimizer').click(function () {
        $('body').toggleClass('sidebar-minimized');
        resizeBroadcast();
    });

    $('.brand-minimizer').click(function () {
        $('body').toggleClass('brand-minimized');
    });

    $('.aside-menu-toggler').click(function () {
        $('body').toggleClass('aside-menu-hidden');
        resizeBroadcast();
    });

    $('.mobile-sidebar-toggler').click(function () {
        $('body').toggleClass('sidebar-mobile-show');
        resizeBroadcast();
    });

    $('.sidebar-close').click(function () {
        $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
    });

    /* ---------- Disable moving to top ---------- */
    $('a[href="#"][data-top!=true]').click(function (e) {
        e.preventDefault();
    });

});

/****
 * CARDS ACTIONS
 */

$(document).on('click', '.card-actions a', function (e) {
    e.preventDefault();

    if ($(this).hasClass('btn-close')) {
        $(this).parent().parent().parent().fadeOut();
    } else if ($(this).hasClass('btn-minimize')) {
        var $target = $(this).parent().parent().next('.card-body');
        if (!$(this).hasClass('collapsed')) {
            $('i', $(this)).removeClass($.panelIconOpened).addClass($.panelIconClosed);
        } else {
            $('i', $(this)).removeClass($.panelIconClosed).addClass($.panelIconOpened);
        }

    } else if ($(this).hasClass('btn-setting')) {
        $('#myModal').modal('show');
    }

});

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function init(url) {

    /* ---------- Tooltip ---------- */
    $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement": "bottom", delay: {show: 400, hide: 200}});

    /* ---------- Popover ---------- */
    $('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover();

}

// meus scripts

jQuery.fn.extend({
    stepProgressBar: function (currentStep) {
        currentStep = currentStep || this.currentStep() || 1;
        let childs = this
            .addClass("step-progress-bar")
            .find("li")
            .removeClass("step-past step-present step-future");

        childs.find(".content-stick").removeClass("step-past step-future");

        let size = childs.length < 1 ? 100 : 100 / childs.length;
        childs.css("width", size + "%");

        for (let i = 0; i < childs.length; i++) {
            let child = $(childs[i]);
            if (child.find("span.content-wrapper").length === 0) {
                child.wrapInner("<span class='content-wrapper'></span>");
                if (i > 0) child.append("<span class='content-stick'></span>");
                child.prepend("<span class='content-bullet'>" + (i + 1) + "</span>");
            }
            let stepName = i < currentStep - 1 ? "step-past"
                : i === currentStep - 1 ? "step-present"
                    : "step-future";
            child.addClass(stepName);
            if (i > 0) {
                let stickName = stepName === "step-present" ? "step-past" : stepName;
                child.find(".content-stick").addClass(stickName);
            }
            child.css("z-index", childs.length - i);
            child.find(":before").css("z-index", childs.length - i + 2);
        }
        return this;
    },

    currentStep: function () {
        var childs = this.find("li");
        for (let i = 0; i < childs.length; i++) {
            if ($(childs[i]).is(".step-present")) return i + 1;
        }
        return 1;
    },

    countSteps: function () {
        return this.find("li").length;
    },

    isFirstStep: function () {
        return this.countSteps() === 1;
    },

    isLastStep: function () {
        return this.countSteps() === this.currentStep();
    },

    previousStep: function () {
        if (!this.isFirstStep()) this.stepProgressBar(this.currentStep() - 1);
    },

    nextStep: function () {
        if (!this.isLastStep()) this.stepProgressBar(this.currentStep() + 1);
    },

    rewind: function () {
        this.stepProgressBar(1);
    },

    fastForward: function () {
        this.stepProgressBar(this.countSteps());
    },

    controlProgressBar: function (progressBar) {
        let rewind = function () {
            progressBar.rewind();
        };
        let next = function () {
            progressBar.nextStep();
        };
        let previous = function () {
            progressBar.previousStep();
        };
        let fastForward = function () {
            progressBar.fastForward();
        };
        this.empty();
        return this;
    }
});


$("#barra-simples-1").stepProgressBar();
$("#barra-simples-2").stepProgressBar();
$("#barra-simples-3").stepProgressBar(3);

let pb = $("#barra-controle-basico").stepProgressBar(2);
$("#controle-basico").controlProgressBar(pb);

$("#controle-macarrao").controlProgressBar($("#barra-macarrao").stepProgressBar(4));

let ca = $("#barra-controle-personalizado").stepProgressBar(1);
let cb = $("#controle-personalizado").controlProgressBar(ca);
cb.find(".rewind, .fast-forward").remove();

$("#cores-personalizadas").stepProgressBar(4);

let temp = $("#cores-temperatura").stepProgressBar(3);
$("#controle-temperatura").controlProgressBar(temp);


$('.caixa_alta').keyup(function () {
    $(this).val($(this).val().toUpperCase());
});
$('.formatar_nome').keypress(function (e) {
    var str = $(this).val();
    str = str.replace(/(^|\s|$)(?!da|de|di|do|du|d$)(?!na|n$)(.)/g, (geral, match1, match2) => match1 + match2.toUpperCase());
    $(this).val(str);
});


jQuery.validator.addMethod("cnpj", function (value, element) {

    var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
    if (value.length == 0) {
        return false;
    }

    value = value.replace(/\D+/g, '');
    digitos_iguais = 1;

    for (i = 0; i < value.length - 1; i++)
        if (value.charAt(i) != value.charAt(i + 1)) {
            digitos_iguais = 0;
            break;
        }
    if (digitos_iguais)
        return false;

    tamanho = value.length - 2;
    numeros = value.substring(0, tamanho);
    digitos = value.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) {
        return false;
    }
    tamanho = tamanho + 1;
    numeros = value.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

    return (resultado == digitos.charAt(1));
})

$.validator.addMethod("cpf", function (value, element) {
    value = jQuery.trim(value);

    value = value.replace('.', '');
    value = value.replace('.', '');
    cpf = value.replace('-', '');
    while (cpf.length < 11) cpf = "0" + cpf;
    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    var a = [];
    var b = new Number;
    var c = 11;
    for (i = 0; i < 11; i++) {
        a[i] = cpf.charAt(i);
        if (i < 9) b += (a[i] * --c);
    }
    if ((x = b % 11) < 2) {
        a[9] = 0
    } else {
        a[9] = 11 - x
    }
    b = 0;
    c = 11;
    for (y = 0; y < 10; y++) b += (a[y] * c--);
    if ((x = b % 11) < 2) {
        a[10] = 0;
    } else {
        a[10] = 11 - x;
    }

    var retorno = true;
    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

    return this.optional(element) || retorno;

}, "Informe um CPF válido");

$.validator.addMethod('validDate', function (value, element) {
    return this.optional(element) || /^(0?[1-9]|[12][0-9]|3[01])[ /](0?[1-9]|[1][0-2])[ /][0-9]{4}$/.test(value);
}, 'Por favor informe uma data data válida no formato dd/mm/aaaaa');


$.validator.addMethod("min", function(value, element, params) {

    var data_minima = moment("02/03/2018", "DD/MM/YYYY");/*$('#data_minima').val();*/
    var data_informada = moment(value, "DD/MM/YYYY");

    console.log('value ',value)
    console.log('data_informada ',data_informada)


    console.log('min ',data_minima)


    var data = moment("02/03/2018", "DD/MM/YYYY");

//Feito isso basta definir o formato de saída:
    console.log(data.format("YYYY-MM-DD"));


    if(data_informada.format("YYYY-MM-DD") > data_minima.format("YYYY-MM-DD")){
        return true
    } else {
        return false;
    }

}, "Atenção, a data de início da experiência profissional deve ser após a data da formação acadêmica");


function mascaraCpf(valor) {
    return valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3\-\$4");
}

$('.cnpj').mask("99.999.999/9999-99");

function dataPtBr(data) {
    let aux = data.split('-');
    data = aux[2] + '/' + aux[1] + '/' + aux[0];
    return data;
}

$('.datas').mask("99/99/9999");
$('.altura').mask("9.99");
$('.quantidade').mask("99");
$('.nota').mask("9.99");

$(".valor").maskMoney({
    decimal: ",",
    thousands: "."
});

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
