function formatPrice(price)
{
	// formatPrice(200) returns "200.00"
	// formatPrice(50.906) returns "50.91"
	// formatPrice(0.00) returns "0"
	if(Number(price)==0) {
		return "0";
	}
	return price.toFixed(2);
}