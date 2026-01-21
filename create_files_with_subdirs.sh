# Isak Jacobson
# 470 - Operating Systems
# 1/20/26
# Lab 1

set -euo pipefail

LANGS=("Java" "Python" "C" "C++" "Rust" "SQL" "C#" "Assembly" "BASIC" "ML")
MAIN_DIR="$(date +'%Y-%m-%d_%H-%M-%S')"

LOG_FILE=""

# Creates a generic log function to place all msg in log file
log() {
	# Useage: log <msg>
	local ts
	ts="$(date +'%Y-%m-%d_%H-%M-%S')"
	echo "[$ts] $*" | tee -a "$LOG_FILE" >/dev/null
}

# --- Start ---
mkdir -p "$MAIN_DIR"
LOG_FILE="$MAIN_DIR/script.log"

log "Script started!"
log "Created main directory: $MAIN_DIR"

# Create subdirectories
for i in {101..110}; do
	SUB_DIR="$MAIN_DIR/file$i"
	mkdir -p "$SUB_DIR"
	log "Created sub directory: file$i"
	
	idx=0
	# Create files in subdirectories
	for j in {501..510}; do
		FILE="$SUB_DIR/tuser$j.txt"
		echo "${LANGS[$idx]}" > "$FILE"
		log "Created file$i/tuser$j and wrote ${LANGS[$idx]}"
		idx=$((idx + 1))
	done
done

log "Executed script successfully!" 
echo "Done! Main Directory: $MAIN_DIR"
echo "Log File: $LOG_FILE"
