
##### Script to retrieve stock data from the Quandl API *****

# Setup

library(Quandl)


# Set api key

Quandl.api_key("ZNUBmiZ3d-zMyLGBxyUt")


# Get stock from user input

data <- Quandl('GOOG/NASDAQ_ACHC', type = "xts")
