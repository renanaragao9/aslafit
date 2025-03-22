$(document).ready(function () {
    function formatCurrency(value) {
        value = value.replace(/\D/g, "");
        if (value.length > 2) {
            value = value.slice(0, -2) + "," + value.slice(-2);
        }
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function formatCurrencyInput($input) {
        $input.on("input", function () {
            let value = $(this).val();
            $(this).val(formatCurrency(value));
        });

        $input.on("blur", function () {
            let value = $(this).val();
            if (
                !value ||
                parseFloat(value.replace(/\./g, "").replace(",", ".")) <= 0
            ) {
                $(this).val("100,00");
            }
        });
    }

    const $currencyInputs = $('input[data-format="currency"]');
    $currencyInputs.each(function () {
        const $input = $(this);

        const initialValue = $input.val();
        if (initialValue) {
            $input.val(formatCurrency(initialValue));
        }

        formatCurrencyInput($input);

        const observer = new MutationObserver(() => {
            const value = $input.val();
            $input.val(formatCurrency(value));
        });

        observer.observe(this, {
            attributes: true,
            attributeFilter: ["value"],
        });
    });
});
