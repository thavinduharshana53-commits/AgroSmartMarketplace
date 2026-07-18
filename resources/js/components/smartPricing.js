export default function smartPricing(
    suggestionUrl,
    csrfToken,
    formId = 'publishProductForm',
    priceInputId = 'productPrice'
) {
    return {
        pricingLoading: false,
        pricingResult: null,
        pricingError: null,

        async getPriceSuggestion() {
            const form = document.getElementById(formId);

            if (!form) {
                this.pricingError = 'Product form could not be found.';
                return;
            }

            const productName =
                form.querySelector('[name="product_name"]')?.value;

            const category =
                form.querySelector('[name="category"]')?.value;

            const district =
                form.querySelector('[name="district"]')?.value;

            const minimumPrice =
                form.querySelector('[name="minimum_price"]')?.value;

            const currentPrice =
                form.querySelector('[name="price"]')?.value;

            this.pricingError = null;
            this.pricingResult = null;

            if (!productName || !category || !district || !minimumPrice) {
                this.pricingError =
                    'Enter the product name, category, district and minimum price first.';

                 return;
            }

            this.pricingLoading = true;

            try {
                const response = await fetch(suggestionUrl, {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },

                    body: JSON.stringify({
                        product_name: productName,
                        category: category,
                        district: district,
                        minimum_price: minimumPrice,
                        current_price: currentPrice || null,
                    }),
                });

                const data = await response.json();

                if (!response.ok) {
                    const firstValidationError = data.errors
                        ? Object.values(data.errors)[0][0]
                        : null;

                    throw new Error(
                        firstValidationError ||
                        data.message ||
                        'Unable to calculate a suggested price.'
                    );
                }

                this.pricingResult = data.recommendation;
            } catch (error) {
                this.pricingError = error.message;
            } finally {
                this.pricingLoading = false;
            }
        },

        applySuggestedPrice() {
            if (!this.pricingResult) {
                return;
            }

            const priceInput =
                document.getElementById(priceInputId);

            if (!priceInput) {
                this.pricingError =
                    'Product price field could not be found.';

                return;
            }

            priceInput.value =
                this.pricingResult.suggested_price;

            priceInput.dispatchEvent(
                new Event('input', {
                    bubbles: true,
                })
            );
        },

        formatPrice(value) {
            return Number(value).toLocaleString('en-LK', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
        },
    };
}