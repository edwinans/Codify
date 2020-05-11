    for (int i = 0; i < NUMBER_THREAD; i++)
        if (runnings[i]){
            cprint(0, "cancelling %d\n", i + 1);
            pthread_cancel(*thread_id[i]);
        }

    for (int i = 0; i < NUMBER_THREAD; i++){
        cprint(0, "joining %d\n", i + 1);
        pthread_join(*thread_id[i], &ret);
        if (ret != PTHREAD_CANCELED)
            free(ret);
    }

    quit_handler(rc);
