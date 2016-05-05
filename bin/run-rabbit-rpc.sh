nohup ./restart.sh ../var/pid/rebbit-rpc-eune.pid php console rabbitmq:rpc-server riot_api_response_eune  >../var/logs/rpc-eune.out 2>&1 &
nohup ./restart.sh ../var/pid/rebbit-rpc-euw.pid  php console rabbitmq:rpc-server riot_api_response_euw   >../var/logs/rpc-euw.out  2>&1 &
nohup ./restart.sh ../var/pid/rebbit-rpc-na.pid   php console rabbitmq:rpc-server riot_api_response_na    >../var/logs/rpc-na.out   2>&1 &
